<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostInteractionNotification extends Notification
{
    use Queueable;
    
    public $post;
    public $user;
    public $type;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user, Post $post, $type)
    {
        $this->user = $user;
        $this->post = $post;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable) {
        if($this->type == "comment") {
            $text = "commented on";
        } elseif($this->type == "like") {
            $text = "liked";
        }
        return [
            'message' => "{$this->user->name} has {$text} your post.",
            'post_id' => $this->post->id,
            'user_id' => $this->user->id,
            'type' => $this->type
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
