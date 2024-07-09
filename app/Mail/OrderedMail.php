<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderedMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $order;
    /**
     * Create a new message instance.
     */


    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    // /**
    //  * Get the message envelope.
    //  */
    // public function envelope(): Envelope
    // {

    //     return new Envelope(
    //         from: new Address('localhost@localhost.com', 'LOCALHOST'),
    //         replyTo: [
    //             new Address($this->order->user->email, $this->order->user->imie. ' ' .$this->order->user->nazwisko),
    //         ],
    //         subject: __('order_wizard.email_notification.subject',[
    //                          'number' => $this->order->number
    //              ]),
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'emails.ordered',
    //     );
    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    //  */
    // public function attachments(): array
    // {
    //     return [];
    // }

    public function build()
    {
        return $this->subject(
            __('order_wizard.email_notification.subject',[
                'number' => $this->order->number
            ])
        )->markdown('emails.ordered', [
            'title' => __('order_wizard.email_notification.subject', [
                'number' => $this->order->number
            ]),
        ]);
    }
}
