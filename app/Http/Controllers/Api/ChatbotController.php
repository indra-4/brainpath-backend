<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChatbotRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    use ApiResponse;

    /**
     * POST /api/chatbot
     *
     * Acts as an API Gateway: forwards the request to the FastAPI LLM
     * chatbot endpoint and returns its response verbatim.
     */
    public function ask(ChatbotRequest $request): JsonResponse
    {
        $mlBaseUrl = config('services.ml.url', env('ML_SERVICE_URL', 'http://localhost:8000'));
        $mlUrl     = $mlBaseUrl . '/api/v1/chatbot';

        $payload = [
            'message'   => $request->message,
            'course_id' => $request->course_id, // nullable — forwarded as-is
        ];

        try {
            $mlResponse = Http::timeout(30)
                              ->post($mlUrl, $payload);

            if (! $mlResponse->successful()) {
                Log::warning('FastAPI chatbot returned non-200', [
                    'status' => $mlResponse->status(),
                    'body'   => $mlResponse->body(),
                ]);
                return $this->errorResponse('Chatbot service is currently unavailable.', null, 503);
            }

            // Return the ML service response verbatim
            return response()->json($mlResponse->json(), $mlResponse->status());
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('FastAPI chatbot connection failed', ['error' => $e->getMessage()]);
            return $this->errorResponse('Could not connect to the chatbot service.', null, 503);
        }
    }
}
