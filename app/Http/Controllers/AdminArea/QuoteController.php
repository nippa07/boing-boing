<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;
use services\Facade\QuoteFacade;
use services\Facade\QuoteRequestFacade;
use CountryState;

class QuoteController extends ParentController
{
    public function all()
    {
        $response['quotes'] = QuoteFacade::getAllDesc();

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
        $response['countries'] = CountryState::getCountries();

        return view('AdminArea.pages.quotes.edit')->with($response);
    }

    public function view($id)
    {
        $response['countries'] = CountryState::getCountries();
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

    public function sendMail($id)
    {
        QuoteFacade::sendMail($id);

        return redirect()->back()->with('alert-success', "Offer Quote Mail Sent Successfully!");
    }

    public function accept($id)
    {
        QuoteFacade::changeStatus($id, Quote::STATUS['ACCEPTED']);

        return redirect()->back()->with('alert-success', "Quote Marked As Accepted!");
    }

    public function decline($id)
    {
        QuoteFacade::changeStatus($id, Quote::STATUS['DECLINED']);

        return redirect()->back()->with('alert-success', "Quote Marked As Declined!");
    }
}
