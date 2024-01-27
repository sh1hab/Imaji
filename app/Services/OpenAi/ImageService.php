<?php

namespace App\Services\OpenAi;

use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Images\CreateResponse;
use App\Services\Interfaces\ImageServiceInterface;

class ImageService implements ImageServiceInterface
{
    /**
     * Generate Image based on user prompt
     *
     * @param string $prompt
     * @return CreateResponse
     */
    public function generateImage(string $prompt)
    {
        return OpenAI::images()->create([
            'model' => 'dall-e-2',
            'n' => 1,
            'prompt' => $prompt,
            'response_format' => 'b64_json',
            'size' => '1024x1024',
        ]);
    }

}
