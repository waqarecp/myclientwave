<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserTagged extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $appointment;
    public $taggedUser;

    /**
     * Create a new message instance.
     */
    public function __construct(Appointment $appointment, $taggedUser)
    {
        $this->appointment = $appointment;
        $this->taggedUser = $taggedUser;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'You have been tagged in a comment',
            to: $this->taggedUser->email
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.user_tagged',
            with: [
                'appointment' => $this->appointment,
                'taggedUser' => $this->taggedUser,
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
