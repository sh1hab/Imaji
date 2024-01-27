<?php

namespace App\Services\OpenAi;

use OpenAI\Laravel\Facades\OpenAI;
use App\Services\Interfaces\ChatServiceInterface;

class ChatService implements ChatServiceInterface
{
    /**
     * Generates prompt with user keyword
     *
     * @param mixed $userKeyword
     * @return string|null
     */
    public function generatePrompt(mixed $userKeyword): ?string
    {
        $prompt = 'Write a prompt that will be used to generate an image. The image is about ' . $userKeyword;
        $messages[] = ['role' => 'user', 'content' => $prompt];

        $payload = [
            'model' => 'gpt-3.5-turbo',
            'messages' => $messages,
            'temperature' => 0.7
        ];

        $response = OpenAI::chat()->create($payload);

        return $response->choices[0]?->message?->content ?? null;
    }

}
