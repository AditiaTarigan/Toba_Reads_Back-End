<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ForceAppKeyProvider extends ServiceProvider
{
    public function register()
    {
        if (empty(config('app.key'))) {
            config()->set('app.key', 'base64:fjIDwGG3iQPNiw2uF84nt7/2J+XOj6TN/NOinFdyCho=');
        }
    }
}
