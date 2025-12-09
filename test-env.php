<?php
require __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Env;

echo "Testing .env reading:<br>";
echo "APP_KEY from getenv(): " . (getenv('APP_KEY') ?: 'NOT FOUND') . "<br>";
echo "APP_KEY from \$_ENV: " . ($_ENV['APP_KEY'] ?? 'NOT FOUND') . "<br>";

// Load .env manually
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

echo "APP_KEY after Dotenv load: " . ($_ENV['APP_KEY'] ?? 'NOT FOUND') . "<br>";
echo "File .env exists: " . (file_exists(__DIR__ . '/.env') ? 'YES' : 'NO');
