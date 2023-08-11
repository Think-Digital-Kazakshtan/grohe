<?php

namespace App\Notifications;

use App\Channels\SMSChannel;
use App\Messages\SMSMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SendPhoneVerificationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public string $code)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [SMSChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toSMS(object $notifiable): SMSMessage
    {
        return (new SMSMessage)
            ->line('Ваш код верификации: ' . $this->code . '.')
            ->line('Никому не говорите код.');
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