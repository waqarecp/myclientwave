<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
// use Illuminate\Support\Facades\Log;
use Illuminate\Mail\Mailables\Address;

class UserTagged extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $appointment;
    public $appointmentComment;
    public $appointmentCreatedAt;
    public $senderUser;
    public $taggedUser;

    /**
     * Create a new message instance.
     */
    public function __construct(Appointment $appointment, $appointmentComment, $appointmentCreatedAt, $senderUser, $taggedUser)
    {
        $this->appointment = $appointment;
        $this->appointmentComment = $appointmentComment;
        $this->appointmentCreatedAt = $appointmentCreatedAt;
        $this->senderUser = $senderUser;
        $this->taggedUser = $taggedUser;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // Log::info("Sender: {$this->senderUser}, Receiver: {$this->taggedUser}");
        return new Envelope(
            from: new Address(address: env('MAIL_FROM_ADDRESS'), name: env('MAIL_FROM_NAME')),
            subject: 'You have been tagged in a comment',
            to: $this->taggedUser->email,
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
            view: 'emails.user_tagged',
            with: [
                'appointment' => $this->appointment,
                'comment' => $this->appointmentComment,
                'createdAt' => $this->appointmentCreatedAt,
                'senderUser' => $this->senderUser,
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
