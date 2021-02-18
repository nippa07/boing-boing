<?php

namespace services\Mail;

use App\Events\InvoiceMailEvent;
use App\Events\QuoteMailEvent;
use App\Events\QuoteStatusMailEvent;
use App\Events\OrderMailEvent;
use App\Events\SendUserDetailsMailEvent;
use App\Models\Order;
use App\Models\Quote;
use App\Models\User;

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

    public function sendOrderMail(Order $order)
    {
        event(new OrderMailEvent($order));
    }

    public function sendUserDetails(User $user, $password)
    {
        event(new SendUserDetailsMailEvent($user, $password));
    }

    public function sendInvoiceMail(Order $order)
    {
        event(new InvoiceMailEvent($order));
    }
}
