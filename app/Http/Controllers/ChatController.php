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

            // Check if this is an FAQ query
            $faqResponse = $this->handleFAQQuery($userMessage);
            if ($faqResponse) {
                return response()->json(['response' => $faqResponse]);
            }

            // System prompt to guide the model's responses
            $systemPrompt = "You are Pandoy a LeadsAgri Bot, an AI assistant for LeadsAgri Venture. 
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
                'max_tokens' => 800
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

    public function getFAQ()
    {
        $faqs = [
            [
                'question' => 'What services do you offer?',
                'answer' => 'LeadsAgri Venture offers comprehensive agricultural services including crop production, livestock management, agricultural consulting, farm equipment sales and maintenance, and sustainable farming solutions. We specialize in modern farming techniques and technology integration.'
            ],
            [
                'question' => 'What products do you sell?',
                'answer' => 'We offer a wide range of agricultural products including high-quality seeds, fertilizers, pesticides, farm equipment, irrigation systems, and organic farming supplies. Our products are carefully selected to ensure optimal results for your farming needs.'
            ],
            [
                'question' => 'How can I contact you?',
                'answer' => 'You can contact us through multiple channels: Phone: +63 XXX XXX XXXX, Email: info@leadsagri.com, or by filling out the contact form on our website. We also offer online consultation appointments.'
            ],
            [
                'question' => 'Do you ship products?',
                'answer' => 'Yes, we provide delivery services for our products. We offer both local delivery within our service areas and shipping to other locations. Delivery fees and timeframes vary based on your location and order size.'
            ]
        ];

        return response()->json(['faqs' => $faqs]);
    }

    private function handleFAQQuery($message)
    {
        $message = strtolower(trim($message));
        
        $faqKeywords = [
            'services' => 'What services do you offer?',
            'contact' => 'How can I contact you?',
            'shipping' => 'Do you ship products?',
            'payment' => 'What payment methods do you accept?',
        ];

        foreach ($faqKeywords as $keyword => $question) {
            if (strpos($message, $keyword) !== false) {
                return $this->getFAQAnswer($question);
            }
        }

        return null;
    }

    private function getFAQAnswer($question)
    {
        $faqData = [
            'What services do you offer?' => 'LeadsAgri Venture offers comprehensive agricultural services including crop production, livestock management, agricultural consulting, farm equipment sales and maintenance, and sustainable farming solutions. We specialize in modern farming techniques and technology integration.',
            'How can I contact you?' => 'You can contact us through multiple channels: Phone: +63 XXX XXX XXXX, Email: info@leadsagri.com, or by filling out the contact form on our website. We also offer online consultation appointments.',
            'Do you ship products?' => 'Yes, we provide delivery services for our products. We offer both local delivery within our service areas and shipping to other locations. Delivery fees and timeframes vary based on your location and order size.',
            'What payment methods do you accept?' => 'We accept various payment methods including cash, bank transfers, credit/debit cards, and digital payments through GCash, PayMaya, and other mobile payment platforms. We also offer flexible payment terms for bulk orders.',
        ];

        return $faqData[$question] ?? null;
    }
} 