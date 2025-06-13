<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    private $mistralApiKey;
    private $mistralApiUrl = 'https://api.mistral.ai/v1/chat/completions';

    public function __construct()
    {
        $this->mistralApiKey = env('MISTRAL_API_KEY');
        if (!$this->mistralApiKey) {
            Log::error('MISTRAL_API_KEY not found in environment variables');
        }
    }

    public function chat(Request $request)
    {
        try {
            $userMessage = $request->input('message');
            
            if (empty($userMessage)) {
                return response()->json(['error' => 'Message is required'], 400);
            }

            // System prompt to guide the model's responses
            $systemPrompt = "You are LeadsAgri Bot, an AI assistant for LeadsAgri Venture. 
            Your role is to provide accurate and helpful information about LeadsAgri's agricultural 
            services, products, and business information. Always be professional, friendly, and 
            concise in your responses. If you're unsure about any information, acknowledge that 
            and suggest contacting LeadsAgri directly.";

            $requestData = [
                'model' => 'mistral-medium',
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $userMessage]
                ],
                'temperature' => 0.7,
                'max_tokens' => 500
            ];

            Log::info('Sending request to Mistral API', [
                'url' => $this->mistralApiUrl,
                'request_data' => $requestData
            ]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->mistralApiKey,
                'Content-Type' => 'application/json',
            ])->post($this->mistralApiUrl, $requestData);

            Log::info('Mistral API response status', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if ($response->successful()) {
                $botResponse = $response->json()['choices'][0]['message']['content'];
                return response()->json(['response' => $botResponse]);
            } else {
                $errorMessage = 'Mistral API error: ' . $response->status() . ' - ' . $response->body();
                Log::error($errorMessage);
                return response()->json(['error' => 'Failed to get response from AI model: ' . $response->status()], 500);
            }
        } catch (\Exception $e) {
            $errorMessage = 'Chat error: ' . $e->getMessage() . "\n" . $e->getTraceAsString();
            Log::error($errorMessage);
            return response()->json(['error' => 'An error occurred while processing your request: ' . $e->getMessage()], 500);
        }
    }
} 