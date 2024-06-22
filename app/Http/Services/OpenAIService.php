<?php

namespace App\Http\Services;

use GuzzleHttp\Client;

class OpenAIService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.openai.api_key');
    }

    public function chatGPT($messages)
    {
        $messages = [
            [
                "role" => "system",
                "content" => "You are a poetic assistant, skilled in explaining complex programming concepts with creative flair."
            ],
            [
                'role' => 'user',
                'content' => $messages
            ],
            // Add more messages as needed
        ];
        $response = $this->client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
            'json' => [
                'messages' => $messages,
                'model' => 'gpt-3.5-turbo-0125'
            ],
        ]);
        return json_decode($response->getBody()->getContents());
    }
}
