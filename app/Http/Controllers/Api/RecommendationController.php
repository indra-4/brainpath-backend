<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\RecommendationLog;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RecommendationController extends Controller
{
    use ApiResponse;

    /**
     * GET /api/recommendations
     *
     * Flow:
     *  1. Find user's most recently completed course.
     *  2. If no completed course → cold-start fallback using user's interest.
     *  3. Call FastAPI: GET /api/v1/recommend?title={title|interest}
     *  4. Map returned titles to DB courses and persist recommendation_logs.
     *  5. Return enriched course details.
     */
    public function index(): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $mlBaseUrl = config('services.ml.url', env('ML_SERVICE_URL', 'http://127.0.0.1:8001'));
        $mlUrl     = $mlBaseUrl . '/api/v1/recommend';

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
            // No completed course → use the stored interest for cold-start
            if (empty($user->interest)) {
                return $this->successResponse(
                    [],
                    'No completed courses and no interest set. Please complete onboarding first.'
                );
            }

            $queryTitle = $user->interest;
        } else {
            $queryTitle = $sourceCourse->title;
        }

        // ── Step 3: Call FastAPI ML service ───────────────────────────────────
        try {
            $mlResponse = Http::timeout(10)
                              ->get($mlUrl, ['title' => $queryTitle]);

            if (! $mlResponse->successful()) {
                Log::warning('ML service returned non-200 response', [
                    'status' => $mlResponse->status(),
                    'body'   => $mlResponse->body(),
                ]);
                return $this->errorResponse('Recommendation service is currently unavailable.', null, 503);
            }

            $mlData = $mlResponse->json(); // Expected: array of {title, similarity_score}
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('ML service connection failed', ['error' => $e->getMessage()]);
            return $this->errorResponse('Could not connect to the recommendation service.', null, 503);
        }

        if (empty($mlData) || empty($mlData['data'])) {
            return $this->successResponse([], 'No recommendations returned from ML service.');
        }

        // ── Step 4: Map titles to DB courses and persist logs ─────────────────
        $recommendations = [];

        foreach ($mlData['data'] as $item) {
            $title           = $item['title']            ?? null;
            $similarityScore = (float) ($item['similarity_score'] ?? 0.0);

            if (! $title) {
                continue;
            }

            $course = Course::where('title', $title)
                            ->where('is_published', true)
                            ->first();

            if (! $course) {
                continue; // ML returned a title not in our DB — skip gracefully
            }

            // Persist recommendation log (source_course_id is nullable for cold-start)
            RecommendationLog::create([
                'user_id'               => $user->id,
                'source_course_id'      => $sourceCourse?->id,   // null on cold-start
                'recommended_course_id' => $course->id,
                'similarity_score'      => $similarityScore,
                'was_clicked'           => false,
            ]);

            $recommendations[] = [
                'course'           => $course,
                'similarity_score' => $similarityScore,
            ];
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
}
