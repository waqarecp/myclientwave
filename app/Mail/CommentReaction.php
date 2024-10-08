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
        return new Envelope(
            from: new Address(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')),
            subject: 'Someone reacted to your comment',
            to: $this->receiverUser->email,
            replyTo: [
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
