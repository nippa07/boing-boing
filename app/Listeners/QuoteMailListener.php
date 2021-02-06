<?php

namespace App\Listeners;

use App\Events\QuoteMailEvent;
use App\Mail\QuoteMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class QuoteMailListener
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
     * @param  QuoteMailEvent  $event
     * @return void
     */
    public function handle(QuoteMailEvent $event)
    {
        $quote = $event->quote;
        Mail::to($quote['email'])->send(new QuoteMail($quote));
    }
}
