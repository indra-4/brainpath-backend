<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * Return a standard success response.
     *
     * @param  mixed   $data
     * @param  string  $message
     * @param  int     $status
     */
    protected function successResponse(mixed $data = null, string $message = 'Success', int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ], $status);
    }

    /**
     * Return a standard error response.
     *
     * @param  string  $message
     * @param  mixed   $data
     * @param  int     $status
     */
    protected function errorResponse(string $message = 'Error', mixed $data = null, int $status = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'data'    => $data,
            'message' => $message,
        ], $status);
    }
}
