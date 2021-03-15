<?php

namespace services\Order;

use App\Models\Order;
use App\Models\Quote;
use Illuminate\Http\Request;
use services\Facade\MailFacade;
use services\Facade\PaypalFacade;
use services\Facade\QuoteFacade;
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
        $user = UserFacade::checkUser($data);
        $data['user_id'] = $user->id;

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

                QuoteFacade::changeStatus($order->quote_id, Quote::STATUS['ORDERED']);
                MailFacade::sendOrderMail($order);
                MailFacade::sendInvoiceMail($order);

                return ['status' => true, 'order' => $order, 'paypal_link' => null];
            } else {
                $order->status = Order::STATUS['FAILED'];
                $order->save();

                return ['status' => false, 'order' => $order, 'paypal_link' => null];
            }
        } else {
            $resp = PaypalFacade::makePayment($order, $data);

            if ($resp && $resp['paypal_link']) {
                return ['status' => true, 'order' => $order, 'paypal_link' => $resp['paypal_link']];
            }

            return ['status' => false, 'order' => $order, 'paypal_link' => null];
        }

        return ['status' => false, 'order' => $order, 'paypal_link' => null];
    }

    public function paypalSuccess(Request $request, $id)
    {
        $order = $this->get($id);

        $resp = PaypalFacade::checkSuccess($request, $id);

        if ($resp && in_array(strtoupper($resp['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $order->transaction_id = $resp['CORRELATIONID'];
            $order->status = Order::STATUS['PAID'];
            $order->save();

            QuoteFacade::changeStatus($order->quote_id, Quote::STATUS['ORDERED']);
            MailFacade::sendOrderMail($order);
            MailFacade::sendInvoiceMail($order);

            return ['status' => true, 'order' => $order];
        }

        return ['status' => false, 'order' => $order];
    }

    public function paypalCancel($id)
    {
        $order = $this->get($id);
        $order->status = Order::STATUS['CANCELED'];
        $order->save();

        return $order;
    }

    public function changeStatus($id, $admin_status)
    {
        $order = $this->get($id);
        $order->admin_status = $admin_status;
        $order->save();
    }
}
