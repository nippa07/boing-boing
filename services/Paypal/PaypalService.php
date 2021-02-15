<?php

namespace services\Paypal;

use App\Models\Order;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaypalService
{
    public function makePayment(Order $order, $data)
    {
        $product = [];
        $product['items'] = [];

        $product['items'][0] =
            [
                'name' => "Shipping",
                'price' => ($order->quote->shipping_amount),
                'desc'  => "Shipping",
                'qty' => 1
            ];
        foreach ($order->quote->quote_item as $key => $item) {
            $product['items'][$key + 1] =
                [
                    'name' => $item->name,
                    'price' => ($item->price / $item->quantity),
                    'desc'  => $item->description,
                    'qty' => $item->quantity
                ];
        }

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
        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($request->token);

        return $response;
    }
}
