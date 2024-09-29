<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class LeadAssigned extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $lead;
    public $leadCreatedAt;
    public $senderUser;
    public $assignedUser;

    /**
     * Create a new message instance.
     */
    public function __construct(Lead $lead, $leadCreatedAt, $senderUser, $assignedUser)
    {
        $this->lead = $lead;
        $this->leadCreatedAt = $leadCreatedAt;
        $this->senderUser = $senderUser;
        $this->assignedUser = $assignedUser;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // Log::info("Sender: {$this->senderUser}, Receiver: {$this->taggedUser}");
        return new Envelope(
            from: new Address(address: env('MAIL_FROM_ADDRESS'), name: env('MAIL_FROM_NAME')),
            subject: 'You have been assigned a new lead',
            to: $this->assignedUser->email,
            replyTo: 
                [
                    new Address(env('MAIL_NOREPLY_ADDRESS'), env('MAIL_FROM_NAME'))
                ]
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
                'createdAt' => $this->leadCreatedAt,
                'senderUser' => $this->senderUser,
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
