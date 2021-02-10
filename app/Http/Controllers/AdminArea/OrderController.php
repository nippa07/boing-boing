<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use services\Facade\OrderFacade;
use CountryState;

class OrderController extends ParentController
{
    public function all()
    {
        $response['orders'] = OrderFacade::getAll();

        return view('AdminArea.pages.orders.all')->with($response);
    }

    public function add($id = null)
    {
        return view('AdminArea.pages.orders.add');
    }

    public function store(Request $request)
    {
        OrderFacade::make($request->all());

        return redirect(route('admin.orders.all'))->with('alert-success', "Order Added Successfully!");
    }

    public function edit($id)
    {
        $response['order'] = OrderFacade::get($id);

        return view('AdminArea.pages.quotes.edit')->with($response);
    }

    public function view($id)
    {
        $response['countries'] = CountryState::getCountries();
        $response['order'] = OrderFacade::get($id);

        return view('AdminArea.pages.orders.view')->with($response);
    }

    public function update($id, Request $request)
    {
        OrderFacade::updateOrder($id, $request->all());

        return redirect(route('admin.orders.all'))->with('alert-success', "Order Updated Successfully!");
    }

    public function delete($id)
    {
        OrderFacade::delete($id);

        return redirect()->back()->with('alert-success', "Order Deleted Successfully!");
    }
}
