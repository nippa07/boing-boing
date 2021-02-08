<?php

namespace services\Order;

use App\Models\Order;
use services\Facade\MailFacade;
use services\Facade\StripeFacade;
use services\Facade\UserFacade;

class OrderService
{
    protected $order;

    public function __construct()
    {
        $this->order = new Order();
    }

    public function get($id)
    {
        return $this->order->find($id);
    }

    public function getByQuoteId($quote_id)
    {
        return $this->order->getByQuoteId($quote_id);
    }

    public function getAll()
    {
        return $this->order->all();
    }

    public function create($data)
    {
        return $this->order->create($data);
    }

    /**
     * update
     *
     * @param  mixed $order
     * @param  mixed $data
     * @return void
     */
    public function update(Order $order, array $data)
    {
        return $order->update($this->edit($order, $data));
    }

    /**
     * edit
     *
     * @param  mixed $order
     * @param  mixed $data
     */
    protected function edit(Order $order, $data)
    {
        return array_merge($order->toArray(), $data);
    }

    public function delete($id)
    {
        $order = $this->get($id);
        return $order->delete();
    }

    public function updateOrder($id, $data)
    {
        $order = $this->get($id);

        return $this->update($order, $data);
    }

    public function make($data)
    {
        $order = $this->getByQuoteId($data['quote_id']);

        if (!$order) {
            $order = $this->create($data);
        }

        if ($data['payment_type'] == Order::PAYMENT_TYPE['STRIPE']) {
            $resp = StripeFacade::makePayment($order, $data);

            if ($resp) {
                $order->transaction_id = $resp;
                $order->status = Order::STATUS['PAID'];
                $order->save();

                MailFacade::sendOrderMail($order);
                UserFacade::checkUser($data);

                return ['status' => true, 'order' => $order];
            } else {
                $order->status = Order::STATUS['FAILED'];
                $order->save();

                return ['status' => false, 'order' => $order];
            }
        } else {
            // $resp = StripeFacade::makePayment($order, $data);
        }

        return ['status' => false, 'order' => $order];
    }
}
