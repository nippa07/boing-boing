<?php

namespace App\Http\Controllers\CustomerArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use services\Facade\OrderFacade;
use CountryState;
use Illuminate\Support\Facades\Auth;

class OrderController extends ParentController
{
    public function all()
    {
        return view('CustomerArea.pages.orders.all');
    }

    public function add($id = null)
    {
        return view('CustomerArea.pages.orders.add');
    }

    public function store(Request $request)
    {
        OrderFacade::make($request->all());

        return redirect(route('customer.orders.all'))->with('alert-success', "Order Added Successfully!");
    }

    public function edit($id)
    {
        $response['order'] = OrderFacade::get($id);

        if ($response['order'] && $response['order']->user_id == Auth::user()->id) {
            return view('CustomerArea.pages.orders.edit')->with($response);
        }

        return redirect()->back()->with('alert-danger', "Oops! Something went wrong");
    }

    public function view($id)
    {
        $response['countries'] = CountryState::getCountries();
        $response['order'] = OrderFacade::get($id);

        if ($response['order'] && $response['order']->user_id == Auth::user()->id) {
            return view('CustomerArea.pages.orders.view')->with($response);
        }

        return redirect()->back()->with('alert-danger', "Oops! Something went wrong");
    }

    public function update($id, Request $request)
    {
        OrderFacade::updateOrder($id, $request->all());

        return redirect(route('customer.orders.all'))->with('alert-success', "Order Updated Successfully!");
    }

    public function delete($id)
    {
        OrderFacade::delete($id);

        return redirect()->back()->with('alert-success', "Order Deleted Successfully!");
    }
}
