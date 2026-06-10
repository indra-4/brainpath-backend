<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChatbotController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\OnboardingController;
use App\Http\Controllers\Api\RecommendationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes — BrainPath
|--------------------------------------------------------------------------
| Prefix: /api  (set in bootstrap/app.php)
| All routes return { "success": bool, "data": ..., "message": string }
*/

// ── Public Routes (no auth) ────────────────────────────────────────────────
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login',    [AuthController::class, 'login']);
});

// ── Protected Routes (Sanctum) ─────────────────────────────────────────────
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);

    // Onboarding
    Route::post('onboarding/complete', [OnboardingController::class, 'complete']);

    // Courses
    Route::prefix('courses')->group(function () {
        Route::get('/history',        [CourseController::class, 'history']);
        Route::get('/',               [CourseController::class, 'index']);
        Route::get('/{id}',           [CourseController::class, 'show']);
        Route::post('/',              [CourseController::class, 'store']);
        Route::put('/{id}',           [CourseController::class, 'update']);
        Route::delete('/{id}',        [CourseController::class, 'destroy']);
        Route::post('/{id}/progress', [CourseController::class, 'updateProgress']);
    });

    // Admin Analytics
    Route::get('admin/analytics', [CourseController::class, 'adminAnalytics']);

    // Recommendations (FastAPI ML bridge)
    Route::get('recommendations', [RecommendationController::class, 'index']);

    // Chatbot (API Gateway → FastAPI LLM)
    Route::post('chatbot', [ChatbotController::class, 'ask']);
});
