<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\RecommendationLog;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RecommendationController extends Controller
{
    use ApiResponse;

    /**
     * Map short interest keywords (from onboarding) to richer ML search terms.
     */
    private const INTEREST_SEARCH_MAP = [
        'frontend'      => 'HTML CSS JavaScript web development frontend',
        'backend'       => 'Laravel REST API backend server development',
        'data'          => 'data analysis pandas visualization python',
        'ai'            => 'machine learning deep learning artificial intelligence',
        'cybersecurity' => 'cybersecurity ethical hacking penetration testing security',
    ];

    /**
     * Map interest keywords to course category slugs in the database.
     */
    private const INTEREST_CATEGORY_MAP = [
        'frontend'      => 'web-development',
        'backend'       => 'web-development',
        'data'          => 'data-science',
        'ai'            => 'data-science',
        'cybersecurity' => 'cybersecurity',
    ];

    /**
     * GET /api/recommendations
     */
    public function index(): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $mlUrl = $this->mlRecommendationUrl();

        // ── Step 1: Find most recently completed course ────────────────────────
        $lastCompleted = $user->progress()
                              ->with('course')
                              ->where('status', 'completed')
                              ->latest('completed_at')
                              ->first();

        $sourceCourse  = $lastCompleted?->course ?? null;
        $isColdStart   = $sourceCourse === null;

        // ── Step 2: Determine the query title ─────────────────────────────────
        if ($isColdStart) {
            if (empty($user->interest)) {
                return $this->successResponse(
                    ['source_course' => null, 'is_cold_start' => true, 'recommendations' => []],
                    'No completed courses and no interest set. Please complete onboarding first.'
                );
            }

            $queryTitle = $this->buildInterestQueryTitle($user->interest);
        } else {
            $queryTitle = $sourceCourse->title;
        }

        // ── Step 3: Call FastAPI ML service ───────────────────────────────────
        $recommendations = $this->callMlAndMapCourses($mlUrl, $queryTitle, $sourceCourse, $user);

        // ── Step 3b: If ML returned empty on cold-start, try expanded terms ──
        if (empty($recommendations) && $isColdStart) {
            // Not needed anymore since we already expand them above, but we keep the block 
            // empty or just try without expanded terms if you want. Let's just pass here.
        }

        // ── Step 4: Final fallback — recommend from DB by category ────────────
        if (empty($recommendations) && $isColdStart) {
            $recommendations = $this->fallbackRecommendationsByInterest($user->interest);
        }

        $message = $isColdStart
            ? 'Cold-start recommendations retrieved using your interest.'
            : 'Recommendations retrieved successfully.';

        return $this->successResponse([
            'source_course'   => $sourceCourse,
            'is_cold_start'   => $isColdStart,
            'recommendations' => $recommendations,
        ], $message);
    }

    /**
     * POST /api/guest/recommendations
     */
    public function guest(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'has_it_knowledge' => ['nullable', 'boolean'],
            'interest'         => ['required', 'string', 'max:255'],
            'learning_goal'    => ['nullable', 'string', 'max:255'],
            'note'             => ['nullable', 'string', 'max:1000'],
        ]);

        $interest = $validated['interest'];
        $queryTitle = $this->buildInterestQueryTitle($interest);

        $recommendations = $this->callMlAndMapCourses(
            $this->mlRecommendationUrl(),
            $queryTitle,
            null,
            null,
            false
        );

        if (empty($recommendations)) {
            $recommendations = $this->fallbackRecommendationsByInterest($interest);
        }

        return $this->successResponse([
            'source_course'   => null,
            'is_cold_start'   => true,
            'recommendations' => $recommendations,
        ], 'Guest recommendations retrieved successfully.');
    }

    /**
     * Call ML service and map returned titles to DB courses.
     */
    private function callMlAndMapCourses(
        string $mlUrl,
        string $queryTitle,
        ?Course $sourceCourse,
        $user = null,
        bool $shouldLog = true
    ): array
    {
        try {
            $mlResponse = Http::timeout(10)->get($mlUrl, ['title' => $queryTitle]);

            if (! $mlResponse->successful()) {
                Log::warning('ML service returned non-200 response', [
                    'status' => $mlResponse->status(),
                    'body'   => $mlResponse->body(),
                ]);
                return [];
            }

            $mlData = $mlResponse->json();
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('ML service connection failed', ['error' => $e->getMessage()]);
            return [];
        }

        if (empty($mlData) || empty($mlData['recommendations'])) {
            return [];
        }

        $recommendations = [];

        foreach ($mlData['recommendations'] as $item) {
            $title           = $item['title']            ?? null;
            $similarityScore = (float) ($item['cosine_score'] ?? 0.0);

            if (! $title) {
                continue;
            }

            $course = Course::where('title', $title)
                            ->where('is_published', true)
                            ->first();

            if (! $course) {
                continue;
            }

            if ($shouldLog && $user) {
                RecommendationLog::create([
                    'user_id'               => $user->id,
                    'source_course_id'      => $sourceCourse?->id,
                    'recommended_course_id' => $course->id,
                    'similarity_score'      => $similarityScore,
                    'was_clicked'           => false,
                ]);
            }

            $recommendations[] = [
                'course'           => $course,
                'similarity_score' => $similarityScore,
            ];
        }

        return $recommendations;
    }

    private function mlRecommendationUrl(): string
    {
        $mlBaseUrl = config('services.ml.url', env('ML_SERVICE_URL', 'http://127.0.0.1:8001'));

        return rtrim($mlBaseUrl, '/') . '/api/v1/recommend';
    }

    private function buildInterestQueryTitle(string $interest): string
    {
        $queryTitleArr = [];

        foreach ($this->parseInterests($interest) as $rawInterest) {
            $queryTitleArr[] = self::INTEREST_SEARCH_MAP[$rawInterest] ?? $rawInterest;
        }

        return implode(' ', $queryTitleArr);
    }

    private function fallbackRecommendationsByInterest(string $interest): array
    {
        $rawInterests = $this->parseInterests($interest);
        $firstInterest = $rawInterests[0] ?? '';
        $category = self::INTEREST_CATEGORY_MAP[$firstInterest] ?? null;

        return Course::where('is_published', true)
            ->when($category, fn($q) => $q->where('category', $category))
            ->limit(5)
            ->get()
            ->map(fn($course) => [
                'course'           => $course,
                'similarity_score' => 0.5,
            ])
            ->all();
    }

    private function parseInterests(string $interest): array
    {
        return array_values(array_filter(array_map('trim', explode(',', strtolower($interest)))));
    }
}
