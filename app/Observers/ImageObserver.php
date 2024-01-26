<?php

namespace App\Observers;

use App\Jobs\AiGenerateImage;
use App\Jobs\AiGeneratePrompt;
use App\Models\Image;
use App\Services\OpenAi\ChatService;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Auth;

class ImageObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * @param ChatService $chatService
     */
    public function __construct(public ChatService $chatService){}

    public function creating(Image $image): void
    {
        $image->user_id = Auth::user()->id;
    }

    /**
     * @param Image $image
     * @return void
     */
    public function created(Image $image): void
    {
//        AiGenerateImage::dispatch($image);
        AiGeneratePrompt::dispatch($image);
    }
}
