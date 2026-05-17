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
     *  2. Call FastAPI ML service: GET /api/v1/recommend?title={title}
     *  3. Map returned titles to DB courses.
     *  4. Persist recommendation_logs.
     *  5. Return enriched course details.
     */
    public function index(): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // ── Step 1: Find most recently completed course ────────────────────────
        $lastCompleted = $user->progress()
                              ->with('course')
                              ->where('status', 'completed')
                              ->latest('completed_at')
                              ->first();

        if (! $lastCompleted || ! $lastCompleted->course) {
            return $this->successResponse([], 'No completed courses found to base recommendations on.');
        }

        $sourceCourse = $lastCompleted->course;

        // ── Step 2: Call FastAPI ML service ───────────────────────────────────
        $mlBaseUrl = config('services.ml.url', env('ML_SERVICE_URL', 'http://localhost:8000'));
        $mlUrl     = $mlBaseUrl . '/api/v1/recommend';

        try {
            $mlResponse = Http::timeout(10)
                              ->get($mlUrl, ['title' => $sourceCourse->title]);

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

        if (empty($mlData)) {
            return $this->successResponse([], 'No recommendations returned from ML service.');
        }

        // ── Step 3 & 4: Map titles to DB courses and save logs ────────────────
        $recommendations = [];

        foreach ($mlData as $item) {
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

            // Persist recommendation log
            RecommendationLog::create([
                'user_id'               => $user->id,
                'source_course_id'      => $sourceCourse->id,
                'recommended_course_id' => $course->id,
                'similarity_score'      => $similarityScore,
                'was_clicked'           => false,
            ]);

            $recommendations[] = [
                'course'           => $course->load('learningPath'),
                'similarity_score' => $similarityScore,
            ];
        }

        return $this->successResponse([
            'source_course'   => $sourceCourse,
            'recommendations' => $recommendations,
        ], 'Recommendations retrieved successfully.');
    }
}
