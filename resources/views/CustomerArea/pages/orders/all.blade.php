@extends('CustomerArea.layouts.app')

@section('header')
<div class="page-header">
    <h4 class="page-title">Orders</h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="{{route('customer.index')}}">
                <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="javscript:void(0)">Orders</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="groups" class="display table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Payment Type</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Auth::user()->orders as $key => $order)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    <span>{{$order->first_name}}&nbsp;{{$order->last_name}}</span><br>
                                    <span class="badge badge-dark">{{$order->email}}</span>
                                </td>
                                <td>
                                    @switch($order->payment_type)
                                    @case(\App\Models\Order::PAYMENT_TYPE['PAYPAL'])
                                    <span>Paypal Payment</span>
                                    @break
                                    @case(\App\Models\Order::PAYMENT_TYPE['STRIPE'])
                                    <span>Stripe Payment</span>
                                    @break
                                    @case(\App\Models\Order::PAYMENT_TYPE['AFTERPAY'])
                                    <span>Afterpay Payment</span>
                                    @break
                                    @break
                                    @default
                                    @endswitch
                                </td>
                                <td>
                                    @switch($order->status)
                                    @case(\App\Models\Order::STATUS['PLACED'])
                                    <span class="badge badge-primary">Placed</span>
                                    @break
                                    @case(\App\Models\Order::STATUS['PAID'])
                                    <span class="badge badge-success">Paid</span>
                                    @break
                                    @case(\App\Models\Order::STATUS['FAILED'])
                                    <span class="badge badge-danger">Failed</span>
                                    @break
                                    @case(\App\Models\Order::STATUS['CANCELED'])
                                    <span class="badge badge-warning">Canceled</span>
                                    @break
                                    @default
                                    @endswitch
                                </td>
                                <td>{{$order->created_at}}</td>
                                <td class="text-left">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-dark" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item"
                                                href="{{route('customer.orders.view', $order->id)}}">
                                                <i class="fa fa-eye text-secondary"></i>&nbsp;View
                                            </a>
                                            @if ($order->status == \App\Models\Order::STATUS['PAID'])
                                            <div class="dropdown-divider responsive-moblile"></div>
                                            <a class="dropdown-item" target="_blank"
                                                href="{{route('public.order.receipt', $order->id)}}">
                                                <i class="fa fa-receipt text-primary"></i>&nbsp;View Receipt
                                            </a>
                                            @endif
                                            {{-- <div class="dropdown-divider responsive-moblile">
                                            </div>
                                            <a class="dropdown-item delete-btn" data-id="{{$order->id}}"
                                            href="javascript:void(0)">
                                            <i class="fa fa-trash text-danger"></i>&nbsp;Delete
                                            </a> --}}
                                        </div>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#groups').DataTable({
            language: {
                paginate: {
                    next: '<i class="fas fa-chevron-right"></i>',
                    previous: '<i class="fas fa-chevron-left"></i>'
                }
            }
        });
    });

    $(".delete-btn").on('click', function () {
        var id = $(this).attr('data-id');

        swal({
            title: 'Are you sure?',
            text: "This will permanently delete this order!",
            type: 'warning',
            buttons: {
                confirm: {
                    text: 'Yes, delete it!',
                    className: 'btn btn-success'
                },
                cancel: {
                    visible: true,
                    text: 'No, cancel!',
                    className: 'btn btn-danger'
                }
            }
        }).then((willDelete) => {
            if (willDelete) {
                window.location.href = '{{ url("customer/order/delete") }}/' + id;
            }
        });
    });

</script>
@endsection
