<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',      // ← registers /api prefix
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Ensure Sanctum's statefulApi middleware is available for cookie-based SPAs.
        // For pure token auth (mobile / Vue SPA using Bearer), this is optional.
        $middleware->statefulApi();
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Return a uniform JSON error envelope for unauthenticated API requests.
        $exceptions->render(function (\Illuminate\Auth\AuthenticationException $e, Request $request) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'data'    => null,
                    'message' => 'Unauthenticated. Please log in and provide a valid Bearer token.',
                ], 401);
            }
        });
    })->create();

// Vercel Serverless storage handler (Vercel is read-only except /tmp)
if (isset($_ENV['VERCEL']) || env('VERCEL') == "1") {
    $app->useStoragePath('/tmp/storage');
}

return $app;
