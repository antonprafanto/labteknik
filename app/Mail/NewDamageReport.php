<?php

namespace App\Mail;

use App\Models\DamageReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewDamageReport extends Mailable
{
    use Queueable, SerializesModels;

    public $damageReport;

    /**
     * Create a new message instance.
     */
    public function __construct(DamageReport $damageReport)
    {
        $this->damageReport = $damageReport;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Damage Report - ' . $this->damageReport->inventoryItem->name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.damage-reports.new-report',
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
