<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Facades\Log;

class CommentReaction extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $appointment;
    public $appointmentComment;
    public $reactionType;
    public $appointmentNoteCreatedAt;
    public $senderUser;
    public $receiverUser;

    /**
     * Create a new message instance.
     */
    public function __construct(Appointment $appointment, $appointmentComment, $reactionType, $appointmentNoteCreatedAt, $senderUser, $receiverUser)
    {
        $this->appointment = $appointment;
        $this->appointmentComment = $appointmentComment;
        $this->reactionType = $reactionType;
        $this->appointmentNoteCreatedAt = $appointmentNoteCreatedAt;
        $this->senderUser = $senderUser;
        $this->receiverUser = $receiverUser;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // Log the details for debugging
        Log::info('Creating email envelope', [
            'sender' => $this->senderUser,
            'receiver' => $this->receiverUser,
            'receiver_email' => $this->receiverUser->email ?: 'null',
            'from_address' => env('MAIL_FROM_ADDRESS') ?: 'null',
            'reply_to' => env('MAIL_NOREPLY_ADDRESS') ?: 'null',
        ]);

        // Ensure the sender email is set
        $fromAddress = env('MAIL_FROM_ADDRESS');
        if (is_null($fromAddress)) {
            throw new \Exception("MAIL_FROM_ADDRESS is not set in .env.");
        }

        // Ensure the receiver email is set
        if (is_null($this->receiverUser->email)) {
            throw new \Exception("Receiver user email is null.");
        }

        // Ensure the reply-to email is set
        $replyToAddress = env('MAIL_NOREPLY_ADDRESS');
        if (is_null($replyToAddress)) {
            throw new \Exception("MAIL_NOREPLY_ADDRESS is not set in .env.");
        }

        return new Envelope(
            from: new Address(address: $fromAddress, name: env('MAIL_FROM_NAME')),
            subject: 'Someone reacted to your comment',
            to: $this->receiverUser->email,
            replyTo: [new Address($replyToAddress, env('MAIL_FROM_NAME'))]
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.comment-reaction',
            with: [
                'appointment' => $this->appointment,
                'comment' => $this->appointmentComment,
                'reactionType' => $this->reactionType,
                'createdAt' => $this->appointmentNoteCreatedAt,
                'senderUser' => $this->senderUser,
                'receiverUser' => $this->receiverUser,
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
