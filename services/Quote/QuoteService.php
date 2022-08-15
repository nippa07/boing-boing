<?php

namespace services\Quote;

use App\Models\Order;
use App\Models\Quote;
use services\Facade\MailFacade;
use services\Facade\OrderFacade;
use services\Facade\QuoteItemFacade;
use services\Facade\UserFacade;

class QuoteService
{
    protected $quote;

    public function __construct()
    {
        $this->quote = new Quote();
        $this->order = new Order();
    }

    public function get($id)
    {
        return $this->quote->find($id);
    }

    public function getQuoteByQuoteNumber($quote_number)
    {
        return $this->quote->getQuoteByQuoteNumber($quote_number);
    }

    public function getQuoteFromMail($email)
    {
        return $this->quote->getQuoteFromMail($email);
    }

    public function getLastQuote()
    {
        return $this->quote->getLastQuote();
    }

    public function getAll()
    {
        return $this->quote->all();
    }

    public function getAllDesc()
    {
        return $this->quote->orderBy('created_at', 'desc')->get();
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

        $this->update($quote, $data);

        QuoteItemFacade::updateQuoteItem($quote, $data);

        if ($data['resend']) {
            MailFacade::sendQuoteMail($quote);
        }
    }

    public function make($data)
    {
        $data['quote_number'] = $this->getQuoteNumber();
        if ($data['discount'] == null) {
            $data['discount'] = 0;
        }
        $quote = $this->create($data);

        QuoteItemFacade::make($quote, $data);

        MailFacade::sendQuoteMail($quote);
    }

    protected function getQuoteNumber()
    {
        $last_quote = $this->getLastQuote();

        if ($last_quote) {
            $quote_number = "ORD-" . sprintf("%'.05d\n", $last_quote->id + 1);
        } else {
            $quote_number = "ORD-" . sprintf("%'.05d\n", 1);
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

    public function changeStatus($id, $status)
    {
        $quote = $this->get($id);
        $quote->status = $status;
        $quote->save();
    }

    public function makeOrder($id)
    {
        $quote = $this->get($id);
        $data = $quote->toArray();

        $total_amount = 0;
        foreach ($quote->quote_item as $key => $item) {
            $total_amount += $item->price;
        }

        $total_amount = ($total_amount + $quote->shipping_amount) - (($total_amount + $quote->shipping_amount) * ($quote->discount / 100)) + ((($total_amount + $quote->shipping_amount) - (($total_amount + $quote->shipping_amount) * ($quote->discount / 100))) * (10 / 100));

        unset($data["id"]);
        unset($data["quote_number"]);
        unset($data["quote_request_id"]);
        unset($data["created_at"]);
        unset($data["updated_at"]);
        unset($data["shipping_amount"]);
        unset($data["discount"]);

        $user = UserFacade::checkUser($data);
        $data['user_id'] = $user->id;

        $data['quote_id'] = $id;
        $data['status'] = Order::STATUS['PAID'];
        $data['payment_type'] = Order::PAYMENT_TYPE['DIRECT'];
        $data['total_amount'] = $total_amount;

        $order = OrderFacade::getByQuoteId($data['quote_id']);

        if (!$order) {
            $order = OrderFacade::create($data);
            MailFacade::sendInvoiceMail($order);
        }
    }
}
