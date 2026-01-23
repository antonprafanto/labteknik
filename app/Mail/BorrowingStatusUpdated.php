<?php

namespace App\Mail;

use App\Models\BorrowingRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BorrowingStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $borrowingRequest;

    /**
     * Create a new message instance.
     */
    public function __construct(BorrowingRequest $borrowingRequest)
    {
        $this->borrowingRequest = $borrowingRequest;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Borrowing Request Status Updated - ' . $this->borrowingRequest->request_number,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.borrowings.status-updated',
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
