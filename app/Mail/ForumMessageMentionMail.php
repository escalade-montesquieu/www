<?php

namespace App\Mail;

use App\Models\ForumMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForumMessageMentionMail extends Mailable
{
    use Queueable, SerializesModels;

    public ForumMessage $message;

    public function __construct(ForumMessage $message)
    {
        $this->message = $message;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->message->user->username . " vous a mentionné dans un message",
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.forum.mention',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
