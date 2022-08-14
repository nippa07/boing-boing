@extends('AdminArea.layouts.app')

@section('header')
<div class="page-header">
    <h4 class="page-title">Edit Offer Quote</h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="{{route('admin.index')}}">
                <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="{{route('admin.offer.quote.all')}}">Offer Quotes</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="javscript:void(0)">Edit Offer Quote</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form id="update_quote_form" action="{{ route('admin.offer.quote.update', $quote->id) }}" method="post">
                    @csrf
                    <input type="hidden" id="resend" name="resend" value="0">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">First Name</label>
                                <input id="first_name" type="text" name="first_name"
                                    class="form-control form-control-alternative" value="{{$quote->first_name}}"
                                    required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Last Name</label>
                                <input id="last_name" type="text" name="last_name" class="form-control
                                        form-control-alternative" value="{{$quote->last_name}}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input id="email" type="email" name="email"
                                    class="form-control form-control-alternative" value="{{$quote->email}}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Phone</label>
                                <input type="text" name="phone" class="form-control form-control-alternative"
                                    pattern="[0-9]*" value="{{$quote->phone}}" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="name">Company</label>
                                <input id="company" type="text" name="company"
                                    class="form-control form-control-alternative" value="{{$quote->company}}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="name">Address</label>
                                <input id="address" type="text" name="address"
                                    class="form-control form-control-alternative" value="{{$quote->address}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">City</label>
                                <input id="city" type="text" name="city" class="form-control form-control-alternative"
                                    value="{{$quote->city}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Postal Code</label>
                                <input id="postal_code" type="text" name="postal_code"
                                    class="form-control form-control-alternative" value="{{$quote->postal_code}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Country</label>
                                <select class="form-control" name="country" id="country" required>
                                    <option></option>
                                    @foreach($countries as $sn => $country)
                                    @if ($sn == "AU")
                                    <option value="{{ $sn }}" {{$quote->country == $sn? 'selected':''}}>{{ $country }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">State</label>
                                <select class="form-control" id="state" name="state">
                                    <option></option>
                                    @foreach($countries as $sn => $state)
                                    <option value="{{ $sn }}" {{$quote->state == $sn? 'selected':''}}>{{ $state }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <hr>
                            <div class="form-group">
                                <h3> <strong>Shipping</strong></h3>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <span><strong>FREE EXPRESS SHIPPING</strong></span>
                                <input id="shipping_amount" type="hidden" name="shipping_amount"
                                    class="form-control form-control-alternative" value="0" required>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <hr>
                            <div class="form-group">
                                <h3> <strong>Items</strong></h3>
                            </div>
                        </div>
                        @foreach ($quote->quote_item as $key => $item)
                        <div class="item_{{$key+1}}">
                            <div class="row mx-0">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <h6><strong>Item {{$key+1}}</strong></h6>
                                        <label for="name">Sticker Type</label>
                                        <select class="form-control" name="type[]" id="type" required>
                                            <option></option>
                                            <option value="{{\App\Models\QuoteItem::TYPE['BUMPER_STICKERS']}}"
                                                {{$item->type == \App\Models\QuoteItem::TYPE['BUMPER_STICKERS'] ? 'selected':''}}>
                                                Bumper Stickers
                                            </option>
                                            <option value="{{\App\Models\QuoteItem::TYPE['VINYL_STICKERS']}}"
                                                {{$item->type == \App\Models\QuoteItem::TYPE['VINYL_STICKERS'] ? 'selected':''}}>
                                                Vinyl Stickers
                                            </option>
                                            <option value="{{\App\Models\QuoteItem::TYPE['CLEAR_VINYL_STICKERS']}}"
                                                {{$item->type == \App\Models\QuoteItem::TYPE['CLEAR_VINYL_STICKERS'] ? 'selected':''}}>
                                                Clear Vinyl Stickers
                                            </option>
                                            <option
                                                value="{{\App\Models\QuoteItem::TYPE['CLEAR_VINYL_STICKERS_WITH_WHITE_INK']}}"
                                                {{$item->type == \App\Models\QuoteItem::TYPE['CLEAR_VINYL_STICKERS_WITH_WHITE_INK'] ? 'selected':''}}>
                                                Clear Vinyl Stickers With White INK
                                            </option>
                                            <option value="{{\App\Models\QuoteItem::TYPE['HIGH_TRACK_STICKERS']}}"
                                                {{$item->type == \App\Models\QuoteItem::TYPE['HIGH_TRACK_STICKERS'] ? 'selected':''}}>
                                                High Tack Stickers
                                            </option>
                                            <option value="{{\App\Models\QuoteItem::TYPE['BLOCKOUT_VINYL_STICKERS']}}"
                                                {{$item->type == \App\Models\QuoteItem::TYPE['BLOCKOUT_VINYL_STICKERS'] ? 'selected':''}}>
                                                Blockout Vinyl
                                                Stickers</option>
                                            <option
                                                value="{{\App\Models\QuoteItem::TYPE['GOLD_SILVER_VINYL_STICKERS']}}"
                                                {{$item->type == \App\Models\QuoteItem::TYPE['GOLD_SILVER_VINYL_STICKERS'] ? 'selected':''}}>
                                                Gold / Silver Vinyl Stickers
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <h6><strong>&nbsp;</strong></h6>
                                        <label for="name">Turnaround Time</label>
                                        <select class="form-control" name="t_time[]" id="t_time" required>
                                            <option></option>
                                            <option value="{{\App\Models\QuoteItem::TURNAROUND_TIME['1_2_DAYS']}}"
                                                {{$item->t_time == \App\Models\QuoteItem::TURNAROUND_TIME['1_2_DAYS'] ? 'selected':''}}>
                                                1-2 Days
                                            </option>
                                            <option value="{{\App\Models\QuoteItem::TURNAROUND_TIME['2_3_DAYS']}}"
                                                {{$item->t_time == \App\Models\QuoteItem::TURNAROUND_TIME['2_3_DAYS'] ? 'selected':''}}>
                                                2-3 Days
                                            </option>
                                            <option value="{{\App\Models\QuoteItem::TURNAROUND_TIME['3_5_DAYS']}}"
                                                {{$item->t_time == \App\Models\QuoteItem::TURNAROUND_TIME['3_5_DAYS'] ? 'selected':''}}>
                                                3-5 Days
                                            </option>
                                            <option value="{{\App\Models\QuoteItem::TURNAROUND_TIME['5_7_DAYS']}}"
                                                {{$item->t_time == \App\Models\QuoteItem::TURNAROUND_TIME['5_7_DAYS'] ? 'selected':''}}>
                                                5-7 Days
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Quantity</label>
                                        <input id="quantity" type="number" name="quantity[]"
                                            class="form-control form-control-alternative" value="{{$item->quantity}}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Price</label>
                                        <input id="price_{{$key+1}}" type="number" name="price[]" step="any"
                                            class="form-control form-control-alternative" oninput=loadCost()
                                            value="{{$item->price}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Finishing</label>
                                        <select class="form-control" name="finishing[]" id="finishing" required>
                                            <option></option>
                                            <option value="{{\App\Models\QuoteItem::FINISHING['SHEETS']}}"
                                                {{$item->finishing == \App\Models\QuoteItem::FINISHING['SHEETS'] ? 'selected':''}}>
                                                Sheets
                                            </option>
                                            <option value="{{\App\Models\QuoteItem::FINISHING['INDIVIDUALS']}}"
                                                {{$item->finishing == \App\Models\QuoteItem::FINISHING['INDIVIDUALS'] ? 'selected':''}}>
                                                Individuals
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Type Of Vinyl</label>
                                        <select class="form-control" name="vinyl_type[]" id="vinyl_type" required>
                                            <option></option>
                                            <option value="{{\App\Models\QuoteItem::VINYL_TYPE['GLOSS']}}"
                                                {{$item->vinyl_type == \App\Models\QuoteItem::VINYL_TYPE['GLOSS'] ? 'selected':''}}>
                                                Gloss
                                            </option>
                                            <option value="{{\App\Models\QuoteItem::VINYL_TYPE['MATTE']}}"
                                                {{$item->vinyl_type == \App\Models\QuoteItem::VINYL_TYPE['MATTE'] ? 'selected':''}}>
                                                Matte
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Sticker Size</label>
                                        <input id="sticker_size" type="text" name="sticker_size[]"
                                            value="{{$item->sticker_size}}" class="form-control
                                            form-control-alternative" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Corners</label>
                                        <select class="form-control" name="corners[]" id="corners" required>
                                            <option></option>
                                            <option value="{{\App\Models\QuoteItem::CORNERS['NONE']}}"
                                                {{$item->corners == \App\Models\QuoteItem::CORNERS['NONE'] ? 'selected':''}}>
                                                None
                                            </option>
                                            <option value="{{\App\Models\QuoteItem::CORNERS['SQUARE']}}"
                                                {{$item->corners == \App\Models\QuoteItem::CORNERS['SQUARE'] ? 'selected':''}}>
                                                Square
                                            </option>
                                            <option value="{{\App\Models\QuoteItem::CORNERS['ROUNDED']}}"
                                                {{$item->corners == \App\Models\QuoteItem::CORNERS['ROUNDED'] ? 'selected':''}}>
                                                Rounded
                                            </option>
                                            <option value="{{\App\Models\QuoteItem::CORNERS['CUSTOM_SHAPE']}}"
                                                {{$item->corners == \App\Models\QuoteItem::CORNERS['CUSTOM_SHAPE'] ? 'selected':''}}>
                                                Custom Shape
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name">Description</label>
                                        <textarea class="form-control" name="description[]"
                                            rows="3">{{$item->description}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div id="extra_items" class="col-lg-12 px-0">

                        </div>
                        <div class="col-lg-12 text-center">
                            <div class="form-group">
                                <button type="button" class="btn btn-icon btn-round btn-primary" onclick="addItems()">
                                    <i class="fas fa-plus" data-toggle="tooltip" title="Add Item"></i>
                                </button>
                                &nbsp;
                                <button type="button" class="btn btn-icon btn-round btn-danger" onclick="delItems()">
                                    <i class="fas fa-minus" data-toggle="tooltip" title="Delete Item"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <hr>
                            <div class="form-group">
                                <h3> <strong>Discounts</strong></h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Discount Percentage</label>
                                <select class="form-control" name="discount" id="discount" onchange=loadCost()>
                                    <option></option>
                                    <option value="20" {{$quote->discount == 20 ? 'selected':''}}>
                                        20%
                                    </option>
                                    <option value="25" {{$quote->discount == 25 ? 'selected':''}}>
                                        25%
                                    </option>
                                    <option value="30" {{$quote->discount == 30 ? 'selected':''}}>
                                        30%
                                    </option>
                                    <option value="50" {{$quote->discount == 50 ? 'selected':''}}>
                                        50%
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                        </div>
                        <div class="col-lg-12">
                            <hr>
                            <div class="form-group">
                                <h3> <strong>Cost Summary</strong></h3>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <h5>
                                    <strong>Total:</strong>&nbsp;<span id="total">$0.00</span>
                                </h5>
                                <h5>
                                    <strong>Shipping:</strong>&nbsp;<span id="shipping">$0.00</span>
                                </h5>
                                <h5>
                                    <strong>GST:</strong>&nbsp;<span id="gst">$0.00</span>
                                </h5>
                                <h5>
                                    <strong>Grand Total:</strong>&nbsp;<span id="g_total">$0.00</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center">
                            <hr>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    Update
                                </button>
                                &nbsp;
                                <button id="resend_btn" type="button" class="btn btn-primary">
                                    Resend
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .img-div {
        height: 100%;
    }

    .file_link {
        text-decoration: none !important;
    }

</style>
@endsection

@section('js')
<script>
    var items = "{{count($quote->quote_item)}}";

    $(document).ready(function () {
        $('#country').select2({
            placeholder: "Select Country",
            theme: "bootstrap"
        });
        $('#state').select2({
            placeholder: "Select State",
            theme: "bootstrap"
        });
        $('#type').select2({
            placeholder: "Select Sticker Type",
            theme: "bootstrap"
        });
        $('#t_time').select2({
            placeholder: "Select Turnaround Time",
            theme: "bootstrap"
        });
        $('#discount').select2({
            placeholder: "Select Discount",
            theme: "bootstrap"
        });
        getStates();
        loadCost();
    });

    function getStates() {
        var country = $('#country').val();
        $.ajax({
            url: "{{ route('get.states') }}?country=" + country,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            success: function (response) {
                var html = "";
                $.each(response, function (key, state) {
                    html += "<option value='" + key + "'>" +
                        state + "</option>";
                });

                $('#state').html(html);
            }
        });
    }

    function addItems() {
        items++;
        var html = "";
        html = '<div class="item_' + items + '">' +
            '<div class="row mx-0">' +
            '<div class="col-lg-6">' +
            '<div class="form-group">' +
            '<h6><strong>Item ' + items + '</strong></h6>' +
            '<label for="name">Sticker Type</label>' +
            '<select class="form-control" name="type[]" id="type" required>' +
            '<option></option>' +
            '<option value="' + "{{\App\Models\QuoteItem::TYPE['BUMPER_STICKERS']}}" + '">' +
            'Bumper Stickers' +
            '</option>' +
            '<option value="' + "{{\App\Models\QuoteItem::TYPE['VINYL_STICKERS']}}" + '">' +
            'Vinyl Stickers' +
            '</option>' +
            '<option value="' + "{{\App\Models\QuoteItem::TYPE['CLEAR_VINYL_STICKERS']}}" + '">' +
            'Clear Vinyl Stickers' +
            '</option>' +
            '<option value="' + "{{\App\Models\QuoteItem::TYPE['CLEAR_VINYL_STICKERS_WITH_WHITE_INK']}}" + '">' +
            'Clear Vinyl Stickers With White INK' +
            '</option>' +
            '<option value="' + "{{\App\Models\QuoteItem::TYPE['HIGH_TRACK_STICKERS']}}" + '">' +
            'High Tack Stickers' +
            '</option>' +
            '<option value="' + "{{\App\Models\QuoteItem::TYPE['BLOCKOUT_VINYL_STICKERS']}}" + '">' +
            'Blockout Vinyl Stickers' +
            '</option>' +
            '<option value="' + "{{\App\Models\QuoteItem::TYPE['GOLD_SILVER_VINYL_STICKERS']}}" + '">' +
            'Gold / Silver Vinyl Stickers' +
            '</option>' +
            '</select>' +
            '</div>' +
            '</div>' +
            '<div class="col-lg-6">' +
            '<div class="form-group">' +
            '<h6><strong>&nbsp;</strong></h6>' +
            '<label for="name">Turnaround Time</label>' +
            '<select class="form-control" name="t_time[]" id="t_time" required>' +
            '<option></option>' +
            '<option value="' + "{{\App\Models\QuoteItem::TURNAROUND_TIME['1_2_DAYS']}}" + '">' +
            '1-2 Days' +
            '</option>' +
            '<option value="' + "{{\App\Models\QuoteItem::TURNAROUND_TIME['2_3_DAYS']}}" + '">' +
            '2-3 Days' +
            '</option>' +
            '<option value="' + "{{\App\Models\QuoteItem::TURNAROUND_TIME['3_5_DAYS']}}" + '">' +
            '3-5 Days' +
            '</option>' +
            '<option value="' + "{{\App\Models\QuoteItem::TURNAROUND_TIME['5_7_DAYS']}}" + '">' +
            '5-7 Days' +
            '</option>' +
            '</select>' +
            '</div>' +
            '</div>' +
            '<div class="col-lg-6">' +
            '<div class="form-group">' +
            '<label for="name">Quantity</label>' +
            '<input id="quantity" type="number" name="quantity[]" min="1" class="form-control form-control-alternative" required>' +
            '</div>' +
            '</div>' +
            '<div class="col-lg-6">' +
            '<div class="form-group">' +
            '<label for="name">Price</label>' +
            '<input id="price_' + items +
            '" type="number" name="price[]" min="0" class="form-control form-control-alternative" oninput=loadCost() step="any" required>' +
            '</div>' +
            '</div>' +
            '<div class="col-lg-6">' +
            '<div class="form-group">' +
            '<label for="name">Finishing</label>' +
            '<select class="form-control" name="finishing[]" id="finishing" required>' +
            '<option></option>' +
            '<option value="' + "{{\App\Models\QuoteItem::FINISHING['SHEETS']}}" + '">' +
            'Sheets' +
            '</option>' +
            '<option value="' + "{{\App\Models\QuoteItem::FINISHING['INDIVIDUALS']}}" + '">' +
            'Individuals' +
            '</option>' +
            '</select>' +
            '</div>' +
            '</div>' +
            '<div class="col-lg-6">' +
            '<div class="form-group">' +
            '<label for="name">Type Of Vinyl</label>' +
            '<select class="form-control" name="vinyl_type[]" id="vinyl_type" required>' +
            '<option></option>' +
            '<option value="' + "{{\App\Models\QuoteItem::VINYL_TYPE['GLOSS']}}" + '">' +
            'Gloss' +
            '</option>' +
            '<option value="' + "{{\App\Models\QuoteItem::VINYL_TYPE['MATTE']}}" + '">' +
            'Matte' +
            '</option>' +
            '</select>' +
            '</div>' +
            '</div>' +
            '<div class="col-lg-6">' +
            '<div class="form-group">' +
            '<label for="name">Sticker Size</label>' +
            '<input id="sticker_size" type="text" name="sticker_size[]"' +
            'class="form-control form-control-alternative" required>' +
            '</div>' +
            '</div>' +
            '<div class="col-lg-6">' +
            '<div class="form-group">' +
            '<label for="name">Corners</label>' +
            '<select class="form-control" name="corners[]" id="corners" required>' +
            '<option></option>' +
            '<option value="' + " {{\App\Models\QuoteItem::CORNERS['NONE']}}" + '">' +
            'None' +
            '</option>' +
            '<option value="' + "{{\App\Models\QuoteItem::CORNERS['SQUARE']}}" + '">' +
            'Square' +
            '</option>' +
            '<option value="' + "{{\App\Models\QuoteItem::CORNERS['ROUNDED']}}" + '">' +
            'Rounded' +
            '</option>' +
            '<option value="' + " {{\App\Models\QuoteItem::CORNERS['CUSTOM_SHAPE']}}" + '">' +
            'Custom Shape' +
            '</option>' +
            '</select>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="col-lg-12">' +
            '<div class="form-group">' +
            '<label for="name">Description</label>' +
            '<textarea class="form-control" name="description[]" rows="3"></textarea>' +
            '</div>' +
            '</div>' +
            '</div>';

        $('#extra_items').append(html);
    }

    function delItems() {
        console.log(items);
        if (items != 1) {
            $('.item_' + items).html('');
            items--;
        }
    }

    $('#resend_btn').on('click', function () {
        $('#resend').val(1);
        $('#update_quote_form').submit();
    });

    function loadCost() {
        var total = parseFloat(0.00);
        var g_total = parseFloat(0.00);
        var gst = parseFloat(0.00);
        var discount = parseFloat($('#discount').val() ? $('#discount').val() : 0.00);
        var shipping = parseFloat($('#shipping_amount').val() ? $('#shipping_amount').val() : 0.00);
        for (let i = 1; i <= items; i++) {
            total += parseFloat($('#price_' + i).val() ? $('#price_' + i).val() : 0.00);
        }
        total = total - (total * (discount/100))
        gst = parseFloat(((total + shipping) * 10 / 100));
        g_total = parseFloat(total + gst + shipping);

        $('#total').html("$" +
            (Math.round(total * 100) / 100).toFixed(2));
        $('#shipping').html("$" + (Math.round(shipping * 100) /
            100).toFixed(2));
        $('#gst').html("$" + (Math.round(gst * 100) / 100).toFixed(2));
        $('#g_total').html("$" +
            (Math.round(g_total * 100) / 100).toFixed(2));
    }

</script>
@endsection
