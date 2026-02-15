<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $mailMessage; // Naya variable add kiya

    public function __construct($reservation, $mailMessage) // Message yahan receive hoga
    {
        $this->reservation = $reservation;
        $this->mailMessage = $mailMessage;
    }
    
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reservation Update - Naini Restaurant',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.reservation_status',
        );
    }

    public function attachments(): array { return []; }
}