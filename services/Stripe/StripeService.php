<?php

namespace services\Stripe;

use App\Models\Order;
use Stripe;

class StripeService
{
    public function makePayment(Order $order, $data)
    {
        Stripe\Stripe::setApiKey(config('paymentgateways.stripe.secret'));

        $customer = \Stripe\Customer::create([
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'address' => [
                'line1' => $data['address'],
                'postal_code' => $data['postal_code'],
                'city' => $data['city'],
                'state' =>  $data['state'],
                'country' =>  $data['country'],
            ],
            "source" => $data['stripeToken'],
        ]);

        $resp = Stripe\Charge::create([
            "amount" => $data['total_amount'] * 100,
            "currency" => "aud",
            "customer" => $customer->id,
            "description" => "Payment for order " . $order->quote->quote_number
        ]);

        if ($resp && $resp->id) {
            return $resp->id;
        }
        return false;
    }
}
