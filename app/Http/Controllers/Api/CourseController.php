<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InteractionRequest;
use App\Http\Requests\ProgressRequest;
use App\Models\Course;
use App\Models\UserInteraction;
use App\Models\UserProgress;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    use ApiResponse;

    /**
     * GET /api/courses
     * Optional query param: ?path_id=1
     */
    public function index(Request $request): JsonResponse
    {
        $query = Course::with('learningPath')
                       ->where('is_published', true);

        if ($request->filled('path_id')) {
            $query->where('learning_path_id', $request->integer('path_id'));
        }

        $courses = $query->orderBy('learning_path_id')
                         ->orderBy('order_index')
                         ->get();

        return $this->successResponse($courses, 'Courses retrieved successfully.');
    }

    /**
     * GET /api/courses/{id}
     */
    public function show(int $id): JsonResponse
    {
        $course = Course::with(['learningPath', 'prerequisites'])->find($id);

        if (! $course || ! $course->is_published) {
            return $this->errorResponse('Course not found.', null, 404);
        }

        return $this->successResponse($course, 'Course retrieved successfully.');
    }

    /**
     * POST /api/courses/{id}/progress
     */
    public function updateProgress(ProgressRequest $request, int $id): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user   = Auth::user();
        $course = Course::find($id);

        if (! $course) {
            return $this->errorResponse('Course not found.', null, 404);
        }

        $now    = now();
        $status = $request->status;

        $progress = UserProgress::updateOrCreate(
            [
                'user_id'   => $user->id,
                'course_id' => $course->id,
            ],
            array_filter([
                'status'       => $status,
                'score'        => $request->score,
                'attempts'     => $request->attempts ?? 0,
                'started_at'   => $now,
                'completed_at' => $status === 'completed' ? $now : null,
            ], fn ($v) => $v !== null)
        );

        // If transitioning to in_progress or completed, set started_at only once
        if (! $progress->wasRecentlyCreated && $progress->started_at === null) {
            $progress->update(['started_at' => $now]);
        }

        return $this->successResponse($progress, 'Progress updated successfully.');
    }

    /**
     * POST /api/courses/{id}/interaction
     */
    public function logInteraction(InteractionRequest $request, int $id): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user   = Auth::user();
        $course = Course::find($id);

        if (! $course) {
            return $this->errorResponse('Course not found.', null, 404);
        }

        $interaction = UserInteraction::create([
            'user_id'            => $user->id,
            'course_id'          => $course->id,
            'action'             => $request->action,
            'time_spent_seconds' => $request->time_spent_seconds ?? 0,
        ]);

        return $this->successResponse($interaction, 'Interaction logged successfully.', 201);
    }
}
