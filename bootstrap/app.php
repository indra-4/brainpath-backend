<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

$app = Application::configure(basePath: dirname(__DIR__))
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
        $exceptions->render(function (\Throwable $e, Request $request) {
            return response()->json([
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => explode("\n", $e->getTraceAsString())
            ], 500);
        });
    })->create();

// Vercel Serverless: redirect storage & override session/cache to non-DB drivers
if (isset($_ENV['VERCEL']) || getenv('VERCEL') == "1") {
    $app->useStoragePath(sys_get_temp_dir() . '/storage');
    putenv('SESSION_DRIVER=cookie');
    putenv('CACHE_STORE=array');
    putenv('QUEUE_CONNECTION=sync');
    
    // Inject Neon PostgreSQL Credentials (with SNI workaround in password)
    putenv('DB_CONNECTION=pgsql');
    putenv('DB_HOST=ep-noisy-night-aoaqai76.c-2.ap-southeast-1.aws.neon.tech');
    putenv('DB_PORT=5432');
    putenv('DB_DATABASE=neondb');
    putenv('DB_USERNAME=neondb_owner');
    putenv('DB_PASSWORD=endpoint=ep-noisy-night-aoaqai76;npg_k2vErFL1OICS');
    putenv('DB_SSLMODE=require');
}

return $app;
