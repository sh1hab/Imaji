<?php

namespace App\Jobs;

use App\Models\Image;
use App\Services\Interfaces\ChatServiceInterface;
use App\Services\OpenAi\ChatService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use OpenAI\Responses\Images\CreateResponse;

class AiGeneratePrompt implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected mixed $data = [];

    /**
     * @param Image $image
     */
    public function __construct(protected Image $image) {}

    /**
     * @param ChatService $chatService
     * @return CreateResponse
     */
    public function handle(ChatServiceInterface $chatService)
    {
        $prompt = $chatService->generatePrompt($this->image->keyword);

        if ($prompt) {
            AiGenerateImage::dispatch($this->image);

            $this->image->update([
                'progress' => 50,
                'prompt' => trim($prompt, '"'),
            ]);
        }else{
            $this->image->update([
                'status' => Image::STATUS_FAILED
            ]);
        }
    }

}
