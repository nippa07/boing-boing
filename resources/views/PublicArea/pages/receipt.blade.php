@extends('PublicArea.layouts.app')

@section('content')
<div class="container">
    <div class="row py-4 justify-content-center">
        <div class="col-lg-9 mt-4">
            <a href="{{url('/')}}" class="btn btn-primary">
                <i class="fas fa-home" data-toggle="tooltip" title="Back to home"></i>
            </a>
            <div class="card shadow mt-4">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <img src="{{asset('PublicArea/img/logo.webp')}}" alt="logo" style="max-width: 15rem;">
                    </h5>
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-10">
                            <h5>Invoice Details</h5>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr class="item_tr">
                                        <th>
                                            Invoice Number:
                                        </th>
                                        <td>
                                            {{$order->quote ? $order->quote->quote_number : ''}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Invoice Status:
                                        </th>
                                        <td>
                                            @switch($order->status)
                                            @case(\App\Models\Order::STATUS['PLACED'])
                                            <span class="badge badge-info">Placed</span>
                                            @break
                                            @case(\App\Models\Order::STATUS['PAID'])
                                            <span class="badge badge-success">Paid</span>
                                            @break
                                            @case(\App\Models\Order::STATUS['FAILED'])
                                            <span class="badge badge-warning">Failed</span>
                                            @break
                                            @case(\App\Models\Order::STATUS['CANCELED'])
                                            <span class="badge badge-danger">Canceled</span>
                                            @break
                                            @default
                                            @endswitch
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Invoice Date:
                                        </th>
                                        <td>
                                            {{\carbon\carbon::parse($order->created_at)->format('d/m/Y')}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Paid On:
                                        </th>
                                        <td>
                                            {{\carbon\carbon::parse($order->updated_at)->format('d/m/Y')}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Payment Method:
                                        </th>
                                        <td>
                                            @switch($order->payment_type)
                                            @case(\App\Models\Order::PAYMENT_TYPE['PAYPAL'])
                                            Paypal Payment
                                            @break
                                            @case(\App\Models\Order::PAYMENT_TYPE['STRIPE'])
                                            Stripe Payment
                                            @break
                                            @default
                                            @endswitch
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Transaction ID:
                                        </th>
                                        <td>
                                            {{$order->transaction_id}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Total Amount:
                                        </th>
                                        <td>
                                            ${{$order->total_amount}}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="text-center">
                                <span>You will receive the invoice on your email.</span>
                            </div>
                            <hr>
                            @if ($order->status == \App\Models\Order::STATUS['PAID'])
                            <div class="row justify-content-center">
                                <div class="col-md-8 bg-success text-center py-2 text-white"
                                    style="border-radius: 0.5rem;">
                                    <h5>
                                        <strong><i class="fa fa-check-circle"></i>&nbsp;Thank You for your
                                            payment!</strong>
                                    </h5>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
@endsection

@section('js')

@endsection
