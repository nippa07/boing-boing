<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;
use services\Facade\QuoteFacade;
use CountryState;

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
}
