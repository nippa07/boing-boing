<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use services\Facade\QuoteFacade;
use services\Facade\QuoteRequestFacade;
use CountryState;

class QuoteController extends ParentController
{
    public function all()
    {
        $response['quotes'] = QuoteFacade::getAll();

        return view('AdminArea.pages.quotes.all')->with($response);
    }

    public function add($id = null)
    {
        $response['countries'] = CountryState::getCountries();
        $response['custom_offer'] = null;
        if ($id) {
            $response['custom_offer'] = QuoteRequestFacade::get($id);
        }

        return view('AdminArea.pages.quotes.add')->with($response);
    }

    public function store(Request $request)
    {
        QuoteFacade::make($request->all());

        return redirect(route('admin.offer.quote.all'))->with('alert-success', "Offer Quote Added Successfully!");
    }

    public function edit($id)
    {
        $response['quote'] = QuoteFacade::get($id);

        return view('AdminArea.pages.quotes.edit')->with($response);
    }

    public function view($id)
    {
        $response['quote'] = QuoteFacade::get($id);

        return view('AdminArea.pages.quotes.view')->with($response);
    }

    public function update($id, Request $request)
    {
        QuoteFacade::updateQuote($id, $request->all());

        return redirect(route('admin.offer.quote.all'))->with('alert-success', "Offer Quote Updated Successfully!");
    }

    public function delete($id)
    {
        QuoteFacade::delete($id);

        return redirect()->back()->with('alert-success', "Offer Quote Deleted Successfully!");
    }
}
