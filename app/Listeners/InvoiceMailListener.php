<?php

namespace App\Listeners;

use App\Events\InvoiceMailEvent;
use App\Mail\InvoiceMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class InvoiceMailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  InvoiceMailEvent  $event
     * @return void
     */
    public function handle(InvoiceMailEvent $event)
    {
        $order = $event->order;
        Mail::to($order->email)->send(new InvoiceMail($order));
    }
}
