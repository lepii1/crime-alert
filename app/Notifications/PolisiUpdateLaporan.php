<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PolisiUpdateLaporan extends Notification
{
    use Queueable;

    public $laporan;

    public function __construct($laporan)
    {
        $this->laporan = $laporan;
    }

    public function via($notifiable)
    {
        return ['database'];
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
    public function toArray($notifiable)
    {
        return [
            'message' => "Polisi telah mengupdate laporan: {$this->laporan->judul}.",
            'status' => $this->laporan->status,
            'laporan_id' => $this->laporan->id,
        ];
    }
}
