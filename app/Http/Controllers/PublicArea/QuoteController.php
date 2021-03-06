<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Quote;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use services\Facade\QuoteFacade;
use CountryState;
use services\Facade\OrderFacade;

class QuoteController extends Controller
{
    public function quoteAccept($id)
    {
        QuoteFacade::changeQuoteStatus($id, Quote::STATUS['ACCEPTED']);

        return redirect(route('public.quote.checkout', $id));
    }

    public function quoteDecline($id)
    {
        QuoteFacade::changeQuoteStatus($id, Quote::STATUS['DECLINED']);

        return redirect(route('public.quote.thankYou'));
    }

    public function thankYou()
    {
        return view('PublicArea.pages.thank_you');
    }

    public function checkout($id = null)
    {
        $response['countries'] = CountryState::getCountries();
        $response['quote'] = null;
        if ($id) {
            $response['quote'] = QuoteFacade::get($id);
        }

        if ($response['quote'] && $response['quote']->order && $response['quote']->order->status == Order::STATUS['PAID']) {
            return redirect(route('public.order.receipt', $response['quote']->order->id));
        }

        return view('PublicArea.pages.checkout')->with($response);
    }

    public function saveCheckout(Request $request)
    {
        $resp = OrderFacade::make($request->all());

        if ($resp['status']) {
            if ($resp['paypal_link']) {
                return redirect($resp['paypal_link']);
            }
            return redirect(route('public.order.receipt', $resp['order']->id));
        } else {
            return redirect()->back()->with('alert-danger', "Payment Failed!");
        }
    }

    public function receipt($id)
    {
        $response['order'] = OrderFacade::get($id);

        return view('PublicArea.pages.receipt')->with($response);
    }

    public function paypalSuccess($id, Request $request)
    {
        $resp = OrderFacade::paypalSuccess($request, $id);

        if ($resp['status']) {
            return redirect(route('public.order.receipt', $resp['order']->id));
        } else {
            return redirect(route('public.quote.checkout', $resp['order']->quote_id))->with('alert-danger', "Payment Failed!");
        }
    }

    public function paypalCancel($id)
    {
        $order = OrderFacade::paypalCancel($id);

        return redirect(route('public.quote.checkout', $order->quote_id))->with('alert-danger', "Payment Canceled!");
    }

    public function pdfDownload($id)
    {
        $response['order'] = OrderFacade::get($id);
        $response['states'] = CountryState::getStates("AU");

        $pdf = PDF::loadView('PublicArea.pages.order_pdf', $response);

        return $pdf->download('order.pdf');
    }

    public function pdfPrint($id)
    {
        $response['order'] = OrderFacade::get($id);
        $response['states'] = CountryState::getStates("AU");

        $pdf = PDF::loadView('PublicArea.pages.order_pdf', $response);

        return $pdf->stream('order.pdf');
    }
}
