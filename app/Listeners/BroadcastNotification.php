<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Queue\InteractsWithQueue;
use Pusher\Pusher;

class BroadcastNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    // public function handle(object $event): void
    public function handle(NotificationSent $event)
    {
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            ['cluster' => env('PUSHER_APP_CLUSTER')]
        );
        
        // dd($event->notification, $event->response);

        // \Log::info('Notification Data:', ['notification' => $event->notification]);
        // \Log::info('Broadcast Response:', ['response' => $event->response]);
        
        $pusher->trigger('notifications', 'new-notification', [
            'message' => $event->response['data']['message'] ?? $event->notification->data['message'] ?? 'No message available',
            'user_id' => $event->notifiable->id
        ]);
    }
}
