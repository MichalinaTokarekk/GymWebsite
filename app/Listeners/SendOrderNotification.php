<?php

namespace App\Listeners;

use App\Mail\OrderedMail;
use App\Events\OrderedEvent;
use Illuminate\Support\Facades\Mail;


class SendOrderNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderedEvent $event)
    {
        
        // Mail::to($event->order->user->email)
	    //     ->queue(new OrderedMail($event->order));

        Mail::to($event->order->user->email)->send(new OrderedMail($event->order));
        
    }
}
