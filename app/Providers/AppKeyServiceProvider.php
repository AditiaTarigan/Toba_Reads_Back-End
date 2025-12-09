<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppKeyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // SET APP_KEY DI AWAL SEBELUM APAPUN
        if (empty($_ENV['APP_KEY'])) {
            $_ENV['APP_KEY'] = 'base64:fjIDwGG3iQPNiw2uF84nt7/2J+XOj6TN/NOinFdyCho=';
            $_SERVER['APP_KEY'] = 'base64:fjIDwGG3iQPNiw2uF84nt7/2J+XOj6TN/NOinFdyCho=';
            putenv('APP_KEY=base64:fjIDwGG3iQPNiw2uF84nt7/2J+XOj6TN/NOinFdyCho=');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force config
        config()->set('app.key', $_ENV['APP_KEY']);
    }
}
