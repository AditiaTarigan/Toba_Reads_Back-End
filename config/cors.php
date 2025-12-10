<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    // config/cors.php
    'allowed_origins' => [
        'http://localhost:8000',
        'http://127.0.0.1:8000',
        'http://10.0.2.2:8000',
        'http://10.163.229.12:8000', // ← TAMBAHKAN INI
        'http://192.168.170.1:8000',
        '*',
    ], // Development only
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
