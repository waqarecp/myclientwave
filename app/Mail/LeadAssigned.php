<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeadAssigned extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $lead;
    public $assignedUser;

    /**
     * Create a new message instance.
     */
    public function __construct(Lead $lead, $assignedUser)
    {
        $this->lead = $lead;
        $this->assignedUser = $assignedUser;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'You have been assigned a new lead',
            to: $this->assignedUser->email
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.lead_assigned',
            with: [
                'lead' => $this->lead,
                'assignedUser' => $this->assignedUser,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
