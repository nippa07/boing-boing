<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
}
