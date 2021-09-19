<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{$order->quote ? $order->quote->quote_number : ''}}</title>

</head>
<style>
    .page-link:hover {
        z-index: 2;
        color: #0056b3;
        text-decoration: none;
        background-color: #e9ecef;
        border-color: #dee2e6
    }

    .page-item:first-child .page-link {
        border-top-left-radius: .2rem;
        border-bottom-left-radius: .2rem
    }

    .page-item:last-child .page-link {
        border-top-right-radius: .2rem;
        border-bottom-right-radius: .2rem
    }

    #layout-wrapper {
        margin-right: auto;
        /* 1 */
        margin-left: auto;
        /* 1 */

        max-width: 960px;
        /* 2 */

        padding-right: 10px;
        /* 3 */
        padding-left: 10px;
        /* 3 */
    }

    .main {
        display: block
    }

    .list-inline {
        padding-left: 0;
        list-style: none
    }

    .list-inline-item {
        display: inline-block
    }

    .list-inline-item:not(:last-child) {
        margin-right: .5rem
    }

    .text-muted {
        color: #6c757d !important
    }

    .container-fluid {
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto
    }

    .container-fluid {
        padding-right: 0;
        padding-left: 0
    }

    .float-right {
        float: right !important
    }

    .font-size-16 {
        font-size: 16px;
        font-family: 'Courier New', Courier, monospace;
    }

    .logo {
        display: block;
        padding: 2px;
        margin: 1px;
        margin-left: -4px;
    }

    .badge {
        display: inline-block;
        padding: .25em .4em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25rem
    }

    .badge-success {
        color: #fff;
        background-color: #28a745
    }

    .badge-success[href]:focus,
    .badge-success[href]:hover {
        color: #fff;
        text-decoration: none;
        background-color: #1e7e34
    }

    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent
    }

    .table td,
    .table th {
        padding: .75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6
    }

    .table tbody+tbody {
        border-top: 2px solid #dee2e6
    }

    .table .table {
        background-color: #fff
    }

    .table-sm td,
    .table-sm th {
        padding: .3rem
    }

    .table-bordered {
        border: 1px solid #dee2e6
    }

    .table-bordered td,
    .table-bordered th {
        border: 1px solid #dee2e6
    }

    .table-bordered thead td,
    .table-bordered thead th {
        border-bottom-width: 2px
    }

    .table-borderless tbody+tbody,
    .table-borderless td,
    .table-borderless th,
    .table-borderless thead th {
        border: 0
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, .05)
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, .075)
    }

    .table-primary,
    .table-primary>td,
    .table-primary>th {
        background-color: #b8daff
    }

    .table-hover .table-primary:hover {
        background-color: #9fcdff
    }

    .table-hover .table-primary:hover>td,
    .table-hover .table-primary:hover>th {
        background-color: #9fcdff
    }

    .table-secondary,
    .table-secondary>td,
    .table-secondary>th {
        background-color: #d6d8db
    }

    .table-hover .table-secondary:hover {
        background-color: #c8cbcf
    }

    .table-hover .table-secondary:hover>td,
    .table-hover .table-secondary:hover>th {
        background-color: #c8cbcf
    }

    .table-success,
    .table-success>td,
    .table-success>th {
        background-color: #c3e6cb
    }

    .table-hover .table-success:hover {
        background-color: #b1dfbb
    }

    .table-hover .table-success:hover>td,
    .table-hover .table-success:hover>th {
        background-color: #b1dfbb
    }

    .table-info,
    .table-info>td,
    .table-info>th {
        background-color: #bee5eb
    }

    .table-hover .table-info:hover {
        background-color: #abdde5
    }

    .table-hover .table-info:hover>td,
    .table-hover .table-info:hover>th {
        background-color: #abdde5
    }

    .table-warning,
    .table-warning>td,
    .table-warning>th {
        background-color: #ffeeba
    }

    .table-hover .table-warning:hover {
        background-color: #ffe8a1
    }

    .table-hover .table-warning:hover>td,
    .table-hover .table-warning:hover>th {
        background-color: #ffe8a1
    }

    .table-danger,
    .table-danger>td,
    .table-danger>th {
        background-color: #f5c6cb
    }

    .table-hover .table-danger:hover {
        background-color: #f1b0b7
    }

    .table-hover .table-danger:hover>td,
    .table-hover .table-danger:hover>th {
        background-color: #f1b0b7
    }

    .table-light,
    .table-light>td,
    .table-light>th {
        background-color: #fdfdfe
    }

    .table-hover .table-light:hover {
        background-color: #ececf6
    }

    .table-hover .table-light:hover>td,
    .table-hover .table-light:hover>th {
        background-color: #ececf6
    }

    .table-dark,
    .table-dark>td,
    .table-dark>th {
        background-color: #c6c8ca
    }

    .table-hover .table-dark:hover {
        background-color: #b9bbbe
    }

    .table-hover .table-dark:hover>td,
    .table-hover .table-dark:hover>th {
        background-color: #b9bbbe
    }

    .table-active,
    .table-active>td,
    .table-active>th {
        background-color: rgba(0, 0, 0, .075)
    }

    .table-hover .table-active:hover {
        background-color: rgba(0, 0, 0, .075)
    }

    .table-hover .table-active:hover>td,
    .table-hover .table-active:hover>th {
        background-color: rgba(0, 0, 0, .075)
    }

    .table .thead-dark th {
        color: #fff;
        background-color: #212529;
        border-color: #32383e
    }

    .table .thead-light th {
        color: #495057;
        background-color: #e9ecef;
        border-color: #dee2e6
    }

    .table-dark {
        color: #fff;
        background-color: #212529
    }

    .table-dark td,
    .table-dark th,
    .table-dark thead th {
        border-color: #32383e
    }

    .table-dark.table-bordered {
        border: 0
    }

    .table-dark.table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(255, 255, 255, .05)
    }

    .table-dark.table-hover tbody tr:hover {
        background-color: rgba(255, 255, 255, .075)
    }

    @media (max-width:575.98px) {
        .table-responsive-sm {
            display: block;
            width: 100%;
        }

        .table-responsive-sm>.table-bordered {
            border: 0
        }
    }

    @media (max-width:767.98px) {
        .table-responsive-md {
            display: block;
            width: 100%;
        }

        .table-responsive-md>.table-bordered {
            border: 0
        }
    }

    @media (max-width:991.98px) {
        .table-responsive-lg {
            display: block;
            width: 100%;
        }

        .table-responsive-lg>.table-bordered {
            border: 0
        }
    }

    @media (max-width:1199.98px) {
        .table-responsive-xl {
            display: block;
            width: 100%;
        }

        .table-responsive-xl>.table-bordered {
            border: 0
        }
    }

    .table-responsive {
        display: block;
        width: 100%;
    }

    .table-responsive>.table-bordered {
        border: 0
    }

    .form-control {
        display: block;
        width: 100%;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        box-shadow .15s ease-in-out
    }

</style>

<body>
    <div id="layout-wrapper">
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="invoice-title">
                                        <h4 class="float-right font-size-16">Order
                                            #{{$order->quote ? $order->quote->quote_number : ''}}</h4>

                                        <div class="mb-4">
                                            {{-- <img src="#" alt="logo" height="20"/> --}}
                                            <img src="{{asset('PublicArea/img/logo.webp')}}" alt="" height="60"
                                                class="logo logo-dark" />
                                        </div>
                                        <hr class="my-4">
                                        <div>
                                            <h5 class="font-size-16 mb-3" style="font-size:16px;margin-bottom: 3px">
                                                Billed To
                                            </h5>
                                            <p>
                                                Name - {{$order->first_name}}&nbsp;{{$order->last_name}}<br>
                                                Email - {{$order->email}}<br>
                                                Phone - {{$order->phone}}<br>
                                                @if ($order->company)
                                                Company - {{$order->company}}<br>
                                                @endif
                                                @if ($order->address)
                                                Address - {{$order->address}}<br>
                                                @endif
                                                @if ($order->city)
                                                City - {{$order->city}}<br>
                                                @endif
                                                @if ($order->postal_code)
                                                Postal Code - {{$order->postal_code}}<br>
                                                @endif
                                                @if ($order->country)
                                                Country - Australia<br>
                                                @endif
                                                @foreach ($states as $key => $state)
                                                @if ($order->state && $order->state == $key)
                                                State - {{$state}}<br>
                                                @endif
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>


                                    <hr class="my-4">

                                    <div class="row" style="width:100%; min-height:30vh; position: absolute;">
                                        <div class="col-sm-6" style="width: 100%; float:left;">
                                            <div>
                                                <h5 class="font-size-16 mb-3" style="font-size:16px;margin-bottom: 3px">
                                                    Order Details
                                                </h5>
                                            </div>
                                            <div>
                                                <h5 class="font-size-16" style="font-size:13px;margin-bottom: 0px">
                                                    Order Number - #{{$order->quote ? $order->quote->quote_number : ''}}
                                                </h5>
                                            </div>
                                            <div>
                                                <h5 class="font-size-16" style="font-size:13px;margin-bottom: 0px">
                                                    Order Status - @switch($order->status)
                                                    @case(\App\Models\Order::STATUS['PLACED'])
                                                    <span>Placed</span>
                                                    @break
                                                    @case(\App\Models\Order::STATUS['PAID'])
                                                    <span>Paid</span>
                                                    @break
                                                    @case(\App\Models\Order::STATUS['FAILED'])
                                                    <span>Failed</span>
                                                    @break
                                                    @case(\App\Models\Order::STATUS['CANCELED'])
                                                    <span>Canceled</span>
                                                    @break
                                                    @default
                                                    @endswitch
                                                </h5>
                                            </div>
                                            <div>
                                                <h5 class="font-size-16" style="font-size:13px;margin-bottom: 0px">
                                                    Order Date -
                                                    {{\carbon\carbon::parse($order->updated_at)->format('d/m/Y')}}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div
                                        style="padding-top:2px; margin-top:50vh; padding-top: 10px;  position: relative;">

                                        <h5 style="font-size:15px;  margin-top:1vh; padding-top:100px;">
                                            Order summary
                                        </h5>
                                        <hr>
                                        <div class="table-responsive" style="width:100%;">
                                            <table class="table table-nowrap table-centered mb-0"
                                                style="text-align: center; word-wrap: wrap none; ">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 70px;">No.</th>
                                                        <th scope="col">Product</th>
                                                        <th scope="col">Quantity</th>
                                                        <th class="text-right" style="width: 120px; text-align: right;">
                                                            Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($order->quote)
                                                    @foreach ($order->quote->quote_item as $key => $item)
                                                    @php
                                                    $item_total[$key] = ($item->price);
                                                    @endphp
                                                    <tr class="item_tr">
                                                        <th scope="row">{{$key+1}}</th>
                                                        <td>
                                                            {{$item->description}}
                                                            @if ($item->description)
                                                            <br>
                                                            @endif
                                                            Type: @switch($item->type)
                                                            @case(\App\Models\QuoteItem::TYPE['BUMPER_STICKERS'])
                                                            Bumper Stickers
                                                            @break
                                                            @case(\App\Models\QuoteItem::TYPE['VINYL_STICKERS'])
                                                            Vinyl Stickers
                                                            @break
                                                            @case(\App\Models\QuoteItem::TYPE['CLEAR_VINYL_STICKERS'])
                                                            Clear Vinyl Stickers
                                                            @break
                                                            @case(\App\Models\QuoteItem::TYPE['CLEAR_VINYL_STICKERS_WITH_WHITE_INK'])
                                                            Clear Vinyl Stickers With White Ink
                                                            @break
                                                            @case(\App\Models\QuoteItem::TYPE['HIGH_TRACK_STICKERS'])
                                                            High Track Stickers
                                                            @break
                                                            @case(\App\Models\QuoteItem::TYPE['BLOCKOUT_VINYL_STICKERS'])
                                                            Blockout Vinyl Stickers
                                                            @break
                                                            @case(\App\Models\QuoteItem::TYPE['GOLD_SILVER_VINYL_STICKERS'])
                                                            Gold/Silver Vinyl Stickers
                                                            @break
                                                            @default
                                                            @endswitch
                                                            <br>
                                                            Turnaround Time: @switch($item->t_time)
                                                            @case(\App\Models\QuoteItem::TURNAROUND_TIME['1_2_DAYS'])
                                                            1-2 Days
                                                            @break
                                                            @case(\App\Models\QuoteItem::TURNAROUND_TIME['2_3_DAYS'])
                                                            2-3 Days
                                                            @break
                                                            @case(\App\Models\QuoteItem::TURNAROUND_TIME['3_5_DAYS'])
                                                            3-5 Days
                                                            @break
                                                            @case(\App\Models\QuoteItem::TURNAROUND_TIME['5_7_DAYS'])
                                                            5-7 Days
                                                            @break
                                                            @default
                                                            @endswitch
                                                            <br>
                                                            Finishing: @switch($item->finishing)
                                                            @case(\App\Models\QuoteItem::FINISHING['SHEETS'])
                                                            Sheets
                                                            @break
                                                            @case(\App\Models\QuoteItem::FINISHING['INDIVIDUALS'])
                                                            Individuals
                                                            @break
                                                            @default
                                                            @endswitch
                                                            <br>
                                                            Type of Vinyl:
                                                            @switch($item->vinyl_type)
                                                            @case(\App\Models\QuoteItem::VINYL_TYPE['GLOSS'])
                                                            Gloss
                                                            @break
                                                            @case(\App\Models\QuoteItem::VINYL_TYPE['MATTE'])
                                                            Matte
                                                            @break
                                                            @default
                                                            @endswitch
                                                            <br>
                                                            Sticker Size: {{$item->sticker_size}}
                                                            <br>
                                                            Corners:
                                                            @switch($item->corners)
                                                            @case(\App\Models\QuoteItem::CORNERS['SQUARE'])
                                                            Square
                                                            @break
                                                            @case(\App\Models\QuoteItem::CORNERS['ROUNDED'])
                                                            Rounded
                                                            @break
                                                            @default
                                                            @endswitch
                                                        </td>
                                                        <td>
                                                            {{$item->quantity}}
                                                        </td>
                                                        <td class="text-right" style="width: 120px; text-align: right;">
                                                            ${{number_format($item_total[$key], 2)}}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                    @php
                                                    if ($order->quote) {
                                                    $total = array_sum($item_total) + $order->quote->shipping_amount +
                                                    ((array_sum($item_total) +
                                                    $order->quote->shipping_amount) * (10/100));
                                                    }else{
                                                    $total = 0;
                                                    }
                                                    @endphp
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <th class="text-right" style="width: 120px; text-align: right;">
                                                            Shipping:
                                                        </th>
                                                        <td class="text-right" style="width: 120px; text-align: right;">
                                                            FREE EXPRESS SHIPPING
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <th class="text-right" style="width: 120px; text-align: right;">
                                                            Sub-Total:
                                                        </th>
                                                        <td class="text-right" style="width: 120px; text-align: right;">
                                                            ${{$order->quote ? number_format(array_sum($item_total) + $order->quote->shipping_amount, 2) : 0}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <th class="text-right" style="width: 120px; text-align: right;">
                                                            GST:
                                                        </th>
                                                        <td class="text-right" style="width: 120px; text-align: right;">
                                                            ${{$order->quote ? number_format((array_sum($item_total) + $order->quote->shipping_amount) * (10/100), 2) : 0}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <th class="text-right" style="width: 120px; text-align: right;">
                                                            Total:
                                                        </th>
                                                        <td class="text-right" style="width: 120px; text-align: right;">
                                                            ${{number_format($total , 2)}}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- container-fluid -->

            </div>
            <!-- End Page-content -->



        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
    <div style="position: absolute;
    bottom: 10px;
    width: 100%;
    border: none;"><br>
        <br>
        <hr>
    </div>



</body>

</html>
