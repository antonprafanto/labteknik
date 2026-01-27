<?php

namespace App\Mail;

use App\Models\RoomBorrowing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RoomBorrowingStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $roomBorrowing;

    /**
     * Create a new message instance.
     */
    public function __construct(RoomBorrowing $roomBorrowing)
    {
        $this->roomBorrowing = $roomBorrowing;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Peminjaman Ruangan - Update Status: ' . $this->roomBorrowing->booking_number,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.room-borrowings.status-updated',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
