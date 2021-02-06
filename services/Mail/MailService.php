<?php

namespace services\Mail;

use App\Events\QuoteMailEvent;
use App\Events\QuoteStatusMailEvent;
use App\Models\Quote;

class MailService
{
    public function sendQuoteMail(Quote $quote)
    {
        event(new QuoteMailEvent($quote));
    }

    public function sendQuoteStatusMail(Quote $quote)
    {
        event(new QuoteStatusMailEvent($quote));
    }
}
