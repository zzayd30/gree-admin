<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class CustomerAccountCreated extends Notification
{
    use Queueable;

    public $temporaryPassword;

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
        // Generate a signed URL that expires in 48 hours for password reset
        $resetUrl = URL::temporarySignedRoute(
            'customer.password.reset',
            now()->addHours(48),
            ['email' => $notifiable->email]
        );

        return (new MailMessage)
                    ->subject('Your Account Has Been Created')
                    ->greeting('Hello ' . $notifiable->name . '!')
                    ->line('Your customer account has been successfully created.')
                    ->line('Your temporary password is: **' . $this->temporaryPassword . '**')
                    ->line('For security reasons, we recommend you set a new password.')
                    ->action('Set Your Password', $resetUrl)
                    ->line('This link will expire in 48 hours.')
                    ->line('If you did not expect this email, please contact our support team.')
                    ->salutation('Best regards, ' . config('app.name'));
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
