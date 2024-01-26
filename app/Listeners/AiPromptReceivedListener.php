<?php

namespace App\Listeners;

use App\Jobs\AiGenerateImage;
use App\Models\Image;

class AiPromptReceivedListener
{
    /**
     * Create the event listener.
     */
    public function __construct(protected Image $image)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        AiGenerateImage::dispatch($this->image);
    }
}
