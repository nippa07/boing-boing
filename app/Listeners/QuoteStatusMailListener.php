<?php

namespace App\Listeners;

use App\Events\QuoteStatusMailEvent;
use App\Mail\QuoteStatusMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class QuoteStatusMailListener
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
     * @param  QuoteStatusMailEvent  $event
     * @return void
     */
    public function handle(QuoteStatusMailEvent $event)
    {
        $quote = $event->quote;
        Mail::to(config('mail.from.address'))->send(new QuoteStatusMail($quote));
    }
}
