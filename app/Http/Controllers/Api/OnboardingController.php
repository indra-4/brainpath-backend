<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OnboardingRequest;
use App\Models\LearningPath;
use App\Models\UserLearningPath;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class OnboardingController extends Controller
{
    use ApiResponse;

    /**
     * Simple mapping: interest keyword → learning_path slug.
     *
     * Adjust these slugs to match your seeded learning paths.
     */
    private const INTEREST_MAP = [
        'web'        => 'web-development',
        'mobile'     => 'mobile-development',
        'data'       => 'data-science',
        'network'    => 'networking',
        'security'   => 'cybersecurity',
        'ai'         => 'data-science',
        'machine'    => 'data-science',
        'design'     => 'web-development',
        'backend'    => 'web-development',
        'frontend'   => 'web-development',
    ];

    /**
     * POST /api/onboarding/complete
     */
    public function complete(OnboardingRequest $request): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1. Resolve learning path from interest keyword
        $interest = strtolower($request->selected_interest);
        $slug     = $this->resolveSlug($interest);

        $learningPath = LearningPath::where('slug', $slug)
                                    ->where('is_active', true)
                                    ->first();

        if (! $learningPath) {
            // Fall back to the first active path if no match
            $learningPath = LearningPath::where('is_active', true)->first();
        }

        if (! $learningPath) {
            return $this->errorResponse('No active learning paths available.', null, 404);
        }

        // 2. Update user profile
        $user->update([
            'has_it_knowledge' => $request->has_it_knowledge,
            'current_path_id'  => $learningPath->id,
            'is_new_user'      => false,
        ]);

        // 3. Sync to user_learning_paths (upsert so re-onboarding doesn't duplicate)
        UserLearningPath::updateOrCreate(
            [
                'user_id'          => $user->id,
                'learning_path_id' => $learningPath->id,
            ],
            [
                'is_active'   => true,
                'enrolled_at' => now(),
            ]
        );

        return $this->successResponse([
            'user'          => $user->fresh(),
            'learning_path' => $learningPath,
        ], 'Onboarding completed successfully.');
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    private function resolveSlug(string $interest): string
    {
        foreach (self::INTEREST_MAP as $keyword => $slug) {
            if (str_contains($interest, $keyword)) {
                return $slug;
            }
        }

        // Default to first entry in the map
        return array_values(self::INTEREST_MAP)[0];
    }
}
