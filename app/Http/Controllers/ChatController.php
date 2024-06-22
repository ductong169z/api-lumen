<?php

namespace App\Http\Controllers;

use App\Http\Services\OpenAIService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected $openaiService;

    public function __construct(OpenAIService $openaiService)
    {
        $this->openaiService = $openaiService;
    }

    public function chat(Request $request)
    {
        $messages = $request->input('messages');
        $response = $this->openaiService->chatGPT($messages);
        // Handle the response as needed
        return response()->json($response);
    }
}
