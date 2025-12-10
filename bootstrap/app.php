<?php

// FIX: Load APP_KEY before Laravel boots
if (file_exists($envFile = dirname(__DIR__) . '/.env')) {
    $contents = file_get_contents($envFile);
    if (preg_match('/^APP_KEY=([^\s]+)/m', $contents, $matches)) {
        $key = trim($matches[1], '"\'');
        $_ENV['APP_KEY'] = $key;
        $_SERVER['APP_KEY'] = $key;
        putenv("APP_KEY=$key");
    }
}

// Fallback if still empty
if (empty($_ENV['APP_KEY'])) {
    $_ENV['APP_KEY'] = 'base64:fjIDwGG3iQPNiw2uF84nt7/2J+XOj6TN/NOinFdyCho=';
    $_SERVER['APP_KEY'] = 'base64:fjIDwGG3iQPNiw2uF84nt7/2J+XOj6TN/NOinFdyCho=';
    putenv('APP_KEY=base64:fjIDwGG3iQPNiw2uF84nt7/2J+XOj6TN/NOinFdyCho=');
}

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders([
        \App\Providers\AppKeyServiceProvider::class, // LOAD INI PERTAMA
    ])
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class, // Alias untuk IsAdmin
            // Tambahkan alias auth dan guest dengan guard 'web' untuk menghindari loop
            // <-- PERBAIKAN: Definisi guard
        ]);

        $middleware->web([
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {})->create();
