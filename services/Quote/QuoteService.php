<?php

namespace services\Quote;

use App\Models\Quote;
use services\Facade\MailFacade;
use services\Facade\QuoteItemFacade;

class QuoteService
{
    protected $quote;

    public function __construct()
    {
        $this->quote = new Quote();
    }

    public function get($id)
    {
        return $this->quote->find($id);
    }

    public function getQuoteByQuoteNumber($quote_number)
    {
        return $this->quote->getQuoteByQuoteNumber($quote_number);
    }

    public function getLastQuote()
    {
        return $this->quote->getLastQuote();
    }

    public function getAll()
    {
        return $this->quote->all();
    }

    public function create($data)
    {
        return $this->quote->create($data);
    }

    /**
     * update
     *
     * @param  mixed $quote
     * @param  mixed $data
     * @return void
     */
    public function update(Quote $quote, array $data)
    {
        return $quote->update($this->edit($quote, $data));
    }

    /**
     * edit
     *
     * @param  mixed $quote
     * @param  mixed $data
     */
    protected function edit(Quote $quote, $data)
    {
        return array_merge($quote->toArray(), $data);
    }

    public function delete($id)
    {
        $quote = $this->get($id);
        return $quote->delete();
    }

    public function updateQuote($id, $data)
    {
        $quote = $this->get($id);

        return $this->update($quote, $data);
    }

    public function make($data)
    {
        $data['quote_number'] = $this->getQuoteNumber();
        $quote = $this->create($data);

        QuoteItemFacade::make($quote, $data);

        MailFacade::sendQuoteMail($quote);
    }

    protected function getQuoteNumber()
    {
        $last_quote = $this->getLastQuote();

        if ($last_quote) {
            $quote_number = "ORD-" . sprintf("%'.05d\n", 1);
        } else {
            $quote_number = "ORD-" . sprintf("%'.05d\n", $last_quote->id + 1);
        }


        $new_quote = $this->getQuoteByQuoteNumber($quote_number);

        if ($new_quote) {
            return $this->getQuoteNumber();
        } else {
            return $quote_number;
        }
    }

    public function changeQuoteStatus($id, $status)
    {
        $quote = $this->get($id);

        if ($quote && $quote->status == Quote::STATUS['SENT']) {
            $quote->status = $status;
            $quote->save();

            MailFacade::sendQuoteStatusMail($quote);
        }
    }

    public function sendMail($id)
    {
        $quote = $this->get($id);

        MailFacade::sendQuoteMail($quote);
    }
}
