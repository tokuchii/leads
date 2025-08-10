<?php
/**
 * Debug script for chatbot issues
 * Place this file in your production root directory and access it via browser
 */

// Test 1: Check if routes are accessible
echo "<h2>Chatbot Debug Information</h2>";

// Test 2: Check environment variables
echo "<h3>Environment Check:</h3>";
echo "MISTRAL_API_KEY configured: " . (env('MISTRAL_API_KEY') ? 'YES' : 'NO') . "<br>";
echo "APP_ENV: " . env('APP_ENV', 'NOT SET') . "<br>";
echo "APP_DEBUG: " . (env('APP_DEBUG', false) ? 'TRUE' : 'FALSE') . "<br>";

// Test 3: Check if Laravel is working
echo "<h3>Laravel Check:</h3>";
try {
    require_once __DIR__ . '/vendor/autoload.php';
    $app = require_once __DIR__ . '/bootstrap/app.php';
    echo "Laravel loaded: YES<br>";
} catch (Exception $e) {
    echo "Laravel error: " . $e->getMessage() . "<br>";
}

// Test 4: Check if ChatController can be instantiated
echo "<h3>Controller Check:</h3>";
try {
    require_once __DIR__ . '/vendor/autoload.php';
    $app = require_once __DIR__ . '/bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    $controller = new App\Http\Controllers\ChatController();
    echo "ChatController instantiated: YES<br>";
} catch (Exception $e) {
    echo "ChatController error: " . $e->getMessage() . "<br>";
}

// Test 5: Check if HTTP client is available
echo "<h3>HTTP Client Check:</h3>";
try {
    require_once __DIR__ . '/vendor/autoload.php';
    $app = require_once __DIR__ . '/bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    $response = Illuminate\Support\Facades\Http::get('https://httpbin.org/get');
    echo "HTTP client working: " . ($response->successful() ? 'YES' : 'NO') . "<br>";
} catch (Exception $e) {
    echo "HTTP client error: " . $e->getMessage() . "<br>";
}

echo "<h3>Next Steps:</h3>";
echo "1. Check if MISTRAL_API_KEY is set in your .env file<br>";
echo "2. Test the /chat-test endpoint: <a href='/chat-test' target='_blank'>/chat-test</a><br>";
echo "3. Check Laravel logs in storage/logs/laravel.log<br>";
echo "4. Ensure your web server can reach the Mistral API (https://api.mistral.ai)<br>";
?>
