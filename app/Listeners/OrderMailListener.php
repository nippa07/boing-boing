<?php

namespace App\Listeners;

use App\Events\OrderMailEvent;
use App\Mail\OrderMail as OrderMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class OrderMailListener
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
     * @param  OrderMailEvent  $event
     * @return void
     */
    public function handle(OrderMailEvent $event)
    {
        $order = $event->order;
        Mail::to(config('mail.from.address'))->send(new OrderMail($order));
    }
}
