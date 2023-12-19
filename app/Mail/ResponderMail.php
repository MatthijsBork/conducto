<?php

namespace App\Mail;

use App\Models\House;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Address;

class ResponderMail extends Mailable
{
    use Queueable, SerializesModels;

    private House $house;
    private $data;

    /**
     * Create a new message instance.
     */
    public function __construct(House $house, $data)
    {
        $this->house = $house;
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->data->email,
            from: new Address('noreply@locareo.test', 'Woning'),
            subject: $this->house->title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.responder',
            with: ['house' => $this->house]
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
