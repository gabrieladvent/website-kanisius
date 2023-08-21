<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class KirimNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $filename;
    private $namasekolah;
    private $userLogin;
    private $komen;
    private $status;
    public function __construct($filename, $namasekolah, $userLogin, $komen, $status)
    {
        $this->filename = $filename;
        $this->namasekolah = $namasekolah;
        $this->userLogin = $userLogin;
        $this->komen = $komen;
        $this->status = $status;
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
            'name' =>$this->filename,
            'namasekolah' =>$this->namasekolah,
            'userLogin'=>$this->userLogin,
            'komen' =>$this->komen,
            'status' =>$this->status
        ];
    }
}
