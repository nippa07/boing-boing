<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\Quote;
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

        return view('PublicArea.pages.checkout')->with($response);
    }

    public function saveCheckout(Request $request)
    {
        $resp = OrderFacade::make($request->all());

        if ($resp['status']) {
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
}
