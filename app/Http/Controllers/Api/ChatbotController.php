<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChatbotRequest;
use App\Models\ChatbotRule;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class ChatbotController extends Controller
{
    use ApiResponse;

    private const FALLBACK_RESPONSE = 'Maaf, saya tidak mengerti pertanyaan Anda. Silakan coba kata kunci lain atau hubungi tim support kami untuk bantuan lebih lanjut.';

    /**
     * POST /api/chatbot
     */
    public function reply(ChatbotRequest $request): JsonResponse
    {
        $userMessage = $request->message;

        // Find the highest-priority rule whose keyword appears in the user's message
        $rule = ChatbotRule::where('is_active', true)
                           ->whereRaw('? ILIKE CONCAT(\'%\', keyword, \'%\')', [$userMessage])
                           ->orderByDesc('priority')
                           ->first();

        $reply    = $rule?->response ?? self::FALLBACK_RESPONSE;
        $category = $rule?->category ?? 'fallback';
        $matched  = $rule !== null;

        return $this->successResponse([
            'reply'    => $reply,
            'category' => $category,
            'matched'  => $matched,
        ], 'Chatbot response generated.');
    }
}
