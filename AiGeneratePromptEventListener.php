<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\NewMessageReceivedNotification;

class NewMessageEventListener
{
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $event->user->notify(new NewMessageReceivedNotification(
            $event->title,
            $event->message,
            $event->id,
            $event->createdAt
        ));
    }
}
