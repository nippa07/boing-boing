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
        $quote_number = "ORD-" . str_pad(rand(0, pow(10, 5) - 1), 5, '0', STR_PAD_LEFT);
        $new_event = $this->getQuoteByQuoteNumber($quote_number);

        if ($new_event) {
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
        }

        MailFacade::sendQuoteStatusMail($quote);
    }
}
