<?php
require __DIR__ . '/vendor/autoload.php';

// Test 1: Check ENV
echo "ENV APP_KEY: " . (getenv('APP_KEY') ?: 'NOT SET') . "\n";

// Test 2: Create app
$app = require __DIR__ . '/bootstrap/app.php';

// Test 3: Check config
echo "Config APP_KEY: " . ($app->make('config')->get('app.key') ?: 'NOT SET') . "\n";

// Test 4: Create encryption instance
try {
    $encrypter = $app->make('encrypter');
    echo "Encryption: OK\n";
} catch (Exception $e) {
    echo "Encryption ERROR: " . $e->getMessage() . "\n";
}
