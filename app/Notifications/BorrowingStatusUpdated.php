<?php

namespace App\Notifications;

use App\Models\BorrowingRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BorrowingStatusUpdated extends Notification
{
    use Queueable;

    public $borrowingRequest;

    /**
     * Create a new notification instance.
     */
    public function __construct(BorrowingRequest $borrowingRequest)
    {
        $this->borrowingRequest = $borrowingRequest;
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
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Status Peminjaman Diperbarui',
            'message' => 'Permintaan peminjaman #' . $this->borrowingRequest->request_number . ' telah diubah statusnya menjadi: ' . ucfirst($this->borrowingRequest->status),
            'action_url' => route('borrowings.show', $this->borrowingRequest->id),
            'type' => 'borrowing_status',
        ];
    }
}
