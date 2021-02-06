<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;
use services\Facade\QuoteFacade;
use services\Facade\QuoteRequestFacade;

class HomeController extends Controller
{
    public function customOffer()
    {
        return view('PublicArea.pages.custom_offer');
    }

    public function storeCustomOffer(Request $request)
    {
        QuoteRequestFacade::make($request);

        return redirect()->back()->with('alert-success', "Your custom offer request was submitted successfully!");
    }

    public function quoteAccept($id)
    {
        QuoteFacade::changeQuoteStatus($id, Quote::STATUS['ACCEPTED']);
    }

    public function quoteDecline($id)
    {
        QuoteFacade::changeQuoteStatus($id, Quote::STATUS['DECLINED']);

        return redirect(route(''));
    }
}
