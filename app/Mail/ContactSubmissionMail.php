<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactSubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var array<string, string> */
    public array $payload;

    /**
     * @param  array<string, string>  $payload
     */
    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[ELDITECH Contact] ' . $this->payload['subject'],
            replyTo: [
                $this->payload['email'],
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-submission'
        );
    }
}
