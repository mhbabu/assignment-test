<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RoomBookingRequestNotification extends Notification
{
    use Queueable;
    public $bookingData;

    /**
     * Create a new notification instance.
     */
    public function __construct($bookingData)
    {
        $this->bookingData = $bookingData;
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
        return (new MailMessage)
            ->subject('Room Booking Confirmation')
            ->line('Hello ' . $this->bookingData->user->name . ',')
            ->line("Your room booking has been " . $this->bookingData->booked_status)
            ->line('Booking time was: ' . $this->bookingData->booked_at)
            ->line('Thank you for choosing us.');
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
