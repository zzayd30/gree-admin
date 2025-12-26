<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class UserAccountCreated extends Notification
{
    use Queueable;

    protected $temporaryPassword;

    /**
     * Create a new notification instance.
     */
    public function __construct($temporaryPassword)
    {
        $this->temporaryPassword = $temporaryPassword;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // Generate a signed URL that expires in 48 hours
        $url = URL::temporarySignedRoute(
            'user.password.reset',
            now()->addHours(48),
            ['email' => $notifiable->email]
        );

        return (new MailMessage)
            ->subject('Your Account Has Been Created')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your account has been created successfully.')
            ->line('Your temporary password is: **' . $this->temporaryPassword . '**')
            ->line('Please click the button below to set up your permanent password.')
            ->action('Set Up Password', $url)
            ->line('This link will expire in 48 hours.')
            ->line('If you did not request this account, please contact the administrator.');
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
