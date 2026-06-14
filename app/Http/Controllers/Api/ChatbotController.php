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
        $mlBaseUrl = config('services.ml.url', env('ML_SERVICE_URL', 'http://127.0.0.1:8001'));
        $mlUrl     = $mlBaseUrl . '/api/v1/chatbot';

        $queryParams = [];
        if ($request->filled('course_id')) {
            $queryParams['course_id'] = (int) $request->course_id;
        }
        
        if (!empty($queryParams)) {
            $mlUrl .= '?' . http_build_query($queryParams);
        }

        $payload = [
            'user_question'  => $request->message,
        ];

        try {
            $mlResponse = Http::timeout(30)
                              ->withoutVerifying()
                              ->withHeaders(['X-API-Key' => env('ML_API_KEY')])
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
