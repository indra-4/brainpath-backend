<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Create Vercel temp directories
if (isset($_ENV['VERCEL']) || getenv('VERCEL') == "1") {
    $dirs = ['framework/views', 'framework/cache', 'framework/sessions', 'logs', 'app'];
    foreach ($dirs as $dir) {
        $path = '/tmp/storage/' . $dir;
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
    }
}

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
