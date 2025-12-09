<?php
echo "Testing Laravel 12 Environment...<br><br>";

// Test 1: Basic PHP
echo "1. PHP Version: " . PHP_VERSION . "<br>";
echo "2. Current dir: " . __DIR__ . "<br>";

// Test 2: .env file
$envPath = __DIR__ . '/.env';
echo "3. .env path: $envPath<br>";
echo "4. .env exists: " . (file_exists($envPath) ? 'YES' : 'NO') . "<br>";

if (file_exists($envPath)) {
    $content = file_get_contents($envPath);
    if (preg_match('/APP_KEY=(.+)/', $content, $matches)) {
        echo "5. APP_KEY in file: " . htmlspecialchars($matches[1]) . "<br>";
    }
}

// Test 3: Environment variables
echo "6. getenv('APP_KEY'): " . (getenv('APP_KEY') ?: 'NULL') . "<br>";
echo "7. \$_ENV['APP_KEY']: " . ($_ENV['APP_KEY'] ?? 'NULL') . "<br>";
