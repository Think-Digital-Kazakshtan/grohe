<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

class SMSChannel
{
	/**
	 * Send the given notification.
	 */
	public function send(object $notifiable, Notification $notification): void
	{
		$message = $notification->toSMS($notifiable);
		$message->to($notifiable->phone)->send();

		// Send notification to the $notifiable instance...
	}
}