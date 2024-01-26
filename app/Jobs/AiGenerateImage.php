<?php

namespace App\Jobs;

use App\Models\Image;
use App\Services\Interfaces\ChatServiceInterface;
use App\Services\Interfaces\ImageServiceInterface;
use App\Services\OpenAi\ChatService;
use App\Services\OpenAi\ImageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use OpenAI\Responses\Images\CreateResponse;

class AiGenerateImage implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected mixed $data = [];

    /**
     * @param Image $image
     */
    public function __construct(protected Image $image){}

    /**
     * @param ChatService $chatService
     * @param ImageService $imageService
     * @return CreateResponse
     */
    public function handle(ChatServiceInterface $chatService, ImageServiceInterface $imageService): CreateResponse
    {
        $response = $imageService->generateImage($this->image->prompt);

        $binaryImageData = base64_decode($response['data'][0]['b64_json']);
        $storagePath = 'public/images/' . uniqid() . '.jpg';
        Storage::put($storagePath, $binaryImageData);

        $this->image->update([
            'path' => Storage::url($storagePath),
            'status' => Image::STATUS_COMPLETED,
            'progress' => 100
        ]);

        return $response;
    }

}
