<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProgressRequest;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
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
     * Optional query param: ?category=web-development
     */
    public function index(Request $request): JsonResponse
    {
        $query = Course::where('is_published', true);

        if ($request->filled('category')) {
            $query->where('category', $request->string('category'));
        }

        $courses = $query->orderBy('category')
                         ->orderBy('order_index')
                         ->get();

        return $this->successResponse($courses, 'Courses retrieved successfully.');
    }

    /**
     * GET /api/courses/{id}
     */
    public function show(int $id): JsonResponse
    {
        $course = Course::with(['prerequisites'])->find($id);

        if (! $course || ! $course->is_published) {
            return $this->errorResponse('Course not found.', null, 404);
        }

        return $this->successResponse($course, 'Course retrieved successfully.');
    }

    /**
     * POST /api/courses
     */
    public function store(CourseRequest $request): JsonResponse
    {
        $course = Course::create([
            'title'            => $request->title,
            'external_url'     => $request->external_url,
            'description'      => $request->description,
            'category'         => $request->category,
            'level'            => $request->level,
            'duration_text'    => $request->duration_text,
            'tags'             => $request->tags ? json_encode($request->tags) : null,
            'summary'          => $request->summary,
            'learning_points'  => $request->learning_points ? json_encode($request->learning_points) : null,
            'is_published'     => true,
        ]);

        return $this->successResponse($course, 'Course created successfully.', 201);
    }

    /**
     * PUT /api/courses/{id}
     */
    public function update(CourseRequest $request, int $id): JsonResponse
    {
        $course = Course::find($id);

        if (! $course) {
            return $this->errorResponse('Course not found.', null, 404);
        }

        $course->update([
            'title'            => $request->title,
            'external_url'     => $request->external_url,
            'description'      => $request->description,
            'category'         => $request->category,
            'level'            => $request->level,
            'duration_text'    => $request->duration_text,
            'tags'             => $request->tags ? json_encode($request->tags) : null,
            'summary'          => $request->summary,
            'learning_points'  => $request->learning_points ? json_encode($request->learning_points) : null,
        ]);

        return $this->successResponse($course, 'Course updated successfully.');
    }

    /**
     * DELETE /api/courses/{id}
     */
    public function destroy(int $id): JsonResponse
    {
        $course = Course::find($id);

        if (! $course) {
            return $this->errorResponse('Course not found.', null, 404);
        }

        $course->delete();

        return $this->successResponse(null, 'Course deleted successfully.');
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
     * GET /api/courses/history
     */
    public function history(Request $request): JsonResponse
    {
        $user = Auth::user();
        
        $history = UserProgress::with('course')
            ->where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($progress) {
                // Return course details injected with progress info
                $data = $progress->course->toArray();
                $data['progress'] = [
                    'status' => $progress->status,
                    'score' => $progress->score,
                    'started_at' => $progress->started_at,
                    'completed_at' => $progress->completed_at,
                    'updated_at' => $progress->updated_at,
                ];
                return $data;
            });

        return $this->successResponse($history, 'History retrieved successfully.');
    }
}
