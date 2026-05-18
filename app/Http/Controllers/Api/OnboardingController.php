<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OnboardingRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OnboardingController extends Controller
{
    use ApiResponse;

    /**
     * POST /api/onboarding/complete
     *
     * 1. Saves the user's interest and marks onboarding as done.
     * 2. Calls the FastAPI cold-start recommendation endpoint.
     * 3. Returns the recommended courses array directly from the ML service.
     */
    public function complete(OnboardingRequest $request): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // ── Step 1: Persist interest & complete onboarding ────────────────────
        $user->update([
            'interest'    => $request->interest,
            'is_new_user' => false,
        ]);

        // ── Step 2: Cold-start — call FastAPI with the interest string ─────────
        $mlBaseUrl = config('services.ml.url', env('ML_SERVICE_URL', 'http://127.0.0.1:8001'));
        $mlUrl     = $mlBaseUrl . '/api/v1/recommend';

        try {
            $mlResponse = Http::timeout(10)
                              ->get($mlUrl, ['title' => $request->interest]);

            if (! $mlResponse->successful()) {
                Log::warning('ML service cold-start returned non-200', [
                    'status' => $mlResponse->status(),
                    'body'   => $mlResponse->body(),
                ]);

                return $this->successResponse([
                    'user'            => $user->fresh(),
                    'recommendations' => [],
                ], 'Onboarding completed. Recommendation service is currently unavailable.');
            }

            $mlJson           = $mlResponse->json();
            $recommendations  = $mlJson['data'] ?? $mlJson ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('ML service connection failed during onboarding cold-start', [
                'error' => $e->getMessage(),
            ]);

            return $this->successResponse([
                'user'            => $user->fresh(),
                'recommendations' => [],
            ], 'Onboarding completed. Could not reach recommendation service.');
        }

        // ── Step 3: Return user + ML-recommended courses ──────────────────────
        return $this->successResponse([
            'user'            => $user->fresh(),
            'recommendations' => $recommendations,
        ], 'Onboarding completed successfully.');
    }
}
