<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use services\Facade\QuoteRequestFacade;

class CustomOfferController extends ParentController
{
    public function all()
    {
        $response['custom_offers'] = QuoteRequestFacade::getAll();

        return view('AdminArea.pages.custom_offer.all')->with($response);
    }

    public function view($id)
    {
        $response['custom_offer'] = QuoteRequestFacade::get($id);

        return view('AdminArea.pages.custom_offer.view')->with($response);
    }

    public function delete($id)
    {
        QuoteRequestFacade::delete($id);

        return redirect()->back()->with('alert-success', "Custom Offer Request Deleted Successfully!");
    }
}
