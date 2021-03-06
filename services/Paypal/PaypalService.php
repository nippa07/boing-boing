<?php

namespace services\Paypal;

use App\Models\Order;
use Illuminate\Http\Request;
use services\Facade\OrderFacade;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaypalService
{
    public function makePayment(Order $order, $data)
    {
        $product = [];
        $product['items'] = [];
        $item_total = 0;

        $product['items'][0] =
            [
                'name' => "Shipping",
                'price' => ($order->quote->shipping_amount),
                'desc'  => "Shipping",
                'qty' => 1
            ];

        foreach ($order->quote->quote_item as $key => $item) {
            $product['items'][$key + 2] =
                [
                    'name' => $item->name,
                    'price' => $item->price,
                    'desc'  => $item->description,
                    'qty' => 1
                ];

            $item_total += $item->price;
        }

        $product['items'][1] =
            [
                'name' => "Tax",
                'price' => ($order->quote->shipping_amount + $item_total) * (10 / 100),
                'desc'  => "Tax",
                'qty' => 1
            ];

        $product['invoice_id'] = $order->quote->quote_number;
        $product['invoice_description'] = "Order #{$product['invoice_id']}";
        $product['return_url'] = route('public.paypal.success', $order->id);
        $product['cancel_url'] = route('public.paypal.cancel', $order->id);
        $product['total'] = $order->total_amount;

        $paypalModule = new ExpressCheckout;

        $res = $paypalModule->setExpressCheckout($product);
        $res = $paypalModule->setExpressCheckout($product, true);

        return $res;
    }

    public function checkSuccess(Request $request, $id)
    {
        $order = OrderFacade::get($id);

        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($request->token);

        if ($response && in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $product = [];
            $product['items'] = [];
            $item_total = 0;

            $product['items'][0] =
                [
                    'name' => "Shipping",
                    'price' => ($order->quote->shipping_amount),
                    'desc'  => "Shipping",
                    'qty' => 1
                ];

            foreach ($order->quote->quote_item as $key => $item) {
                $product['items'][$key + 2] =
                    [
                        'name' => $item->name,
                        'price' => $item->price,
                        'desc'  => $item->description,
                        'qty' => 1
                    ];

                $item_total += $item->price;
            }

            $product['items'][1] =
                [
                    'name' => "Tax",
                    'price' => ($order->quote->shipping_amount + $item_total) * (10 / 100),
                    'desc'  => "Tax",
                    'qty' => 1
                ];

            $product['invoice_id'] = $order->quote->quote_number;
            $product['invoice_description'] = "Order #{$product['invoice_id']}";
            $product['return_url'] = route('public.paypal.success', $order->id);
            $product['cancel_url'] = route('public.paypal.cancel', $order->id);
            $product['total'] = $order->total_amount;

            $response = $paypalModule->doExpressCheckoutPayment($product, $request->token, $response['PAYERID']);

            return $response;
        }
    }
}
