<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CountryState;
use services\Facade\OrderFacade;
use services\Facade\QuoteFacade;

class CommonController extends Controller
{
    /**
     * Get States For Selected Country
     *@param Request $request
     */
    public function getStates(Request $request)
    {
        return CountryState::getStates($request->has('country') ? $request->country : "US");
    }


    public function mailTest()
    {
        $response['quote'] = QuoteFacade::get(1);
        // $response['order'] = OrderFacade::get(20);
        return view('Mail.quote_mail')->with($response);
    }
}
