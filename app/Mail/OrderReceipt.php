<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderReceipt extends Mailable
{
    use Queueable, SerializesModels;

    public $order; // Database order data
    public $cart;  // Session cart data

    /**
     * Constructor mein dono cheezein receive karein
     */
    public function __construct($order, $cart = null)
    {
        $this->order = $order;
        $this->cart = $cart;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Delicious Order Receipt - Naini Restaurant',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order_receipt',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
