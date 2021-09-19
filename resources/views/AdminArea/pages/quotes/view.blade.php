@extends('AdminArea.layouts.app')

@section('header')
<div class="page-header">
    <h4 class="page-title">View Offer Quote</h4>
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
            <a href="{{route('admin.offer.quote.all')}}">View Quotes</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="javscript:void(0)">View Offer Quote</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="name">Sent Date</label>
                            <input id="sent_date" type="text" name="sent_date"
                                class="form-control form-control-alternative" value="{{$quote->created_at}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">First Name</label>
                            <input id="first_name" type="text" name="first_name"
                                class="form-control form-control-alternative" value="{{$quote->first_name}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Last Name</label>
                            <input id="last_name" type="text" name="last_name" class="form-control
                                        form-control-alternative" value="{{$quote->last_name}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input id="email" type="email" name="email" class="form-control form-control-alternative"
                                value="{{$quote->email}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Phone</label>
                            <input type="text" name="phone" class="form-control form-control-alternative"
                                pattern="[0-9]*" value="{{$quote->phone}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="name">Company</label>
                            <input id="company" type="text" name="company" class="form-control form-control-alternative"
                                value="{{$quote->company}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="name">Address</label>
                            <input id="address" type="text" name="address" class="form-control form-control-alternative"
                                value="{{$quote->address}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">City</label>
                            <input id="city" type="text" name="city" class="form-control form-control-alternative"
                                value="{{$quote->city}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Postal Code</label>
                            <input id="postal_code" type="text" name="postal_code"
                                class="form-control form-control-alternative" value="{{$quote->postal_code}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Country</label>
                            <select class="form-control" name="country" id="country" disabled>
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
                            <select class="form-control" id="state" name="state" disabled>
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
                                class="form-control form-control-alternative" value="0" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <hr>
                        <div class="form-group">
                            <h3> <strong>Items</strong></h3>
                        </div>
                    </div>
                    @foreach ($quote->quote_item as $key => $item)
                    <div class="col-lg-6">
                        <div class="form-group">
                            <h6><strong>Item {{$key+1}}</strong></h6>
                            <label for="name">Sticker Type</label>
                            <select class="form-control" name="type[]" id="type" disabled>
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
                                <option value="{{\App\Models\QuoteItem::TYPE['CLEAR_VINYL_STICKERS_WITH_WHITE_INK']}}"
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
                                <option value="{{\App\Models\QuoteItem::TYPE['GOLD_SILVER_VINYL_STICKERS']}}"
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
                            <select class="form-control" name="t_time[]" id="t_time" disabled>
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
                                class="form-control form-control-alternative" value="{{$item->quantity}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Price</label>
                            <input id="price_{{$key+1}}" type="number" name="price[]" step="any"
                                class="form-control form-control-alternative" value="{{$item->price}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Finishing</label>
                            <select class="form-control" name="finishing[]" id="finishing" disabled>
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
                            <select class="form-control" name="vinyl_type[]" id="vinyl_type" disabled>
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
                            <input id="sticker_size" type="text" name="sticker_size[]" value="{{$item->sticker_size}}"
                                class="form-control form-control-alternative" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Corners</label>
                            <select class="form-control" name="corners[]" id="corners" disabled>
                                <option></option>
                                <option value="{{\App\Models\QuoteItem::CORNERS['SQUARE']}}"
                                    {{$item->corners == \App\Models\QuoteItem::CORNERS['SQUARE'] ? 'selected':''}}>
                                    Square
                                </option>
                                <option value="{{\App\Models\QuoteItem::CORNERS['ROUNDED']}}"
                                    {{$item->corners == \App\Models\QuoteItem::CORNERS['ROUNDED'] ? 'selected':''}}>
                                    Rounded
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="name">Description</label>
                            <textarea class="form-control" name="description[]" rows="3"
                                readonly>{{$item->description}}</textarea>
                        </div>
                    </div>
                    @endforeach
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
                            <a class="btn btn-success" href="{{route('admin.offer.quote.send.mail', $quote->id)}}">
                                Resend Quote
                            </a>
                        </div>
                    </div>
                </div>
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
        getStates();
        loadCost();
    });

    function getStates() {
        var country = $('#country').val();
        var sel_state = "{{$quote->state}}";
        $.ajax({
            url: "{{ route('get.states') }}?country=" + country,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            success: function (response) {
                var html = "";
                $.each(response, function (key, state) {
                    html += "<option value='" + key + "'" + (sel_state == key ? 'selected' : '') +
                        ">" +
                        state + "</option>";
                });

                $('#state').html(html);
            }
        });
    }

    function loadCost() {
        var total = parseFloat(0.00);
        var g_total = parseFloat(0.00);
        var gst = parseFloat(0.00);
        var shipping = parseFloat($('#shipping_amount').val() ? $('#shipping_amount').val() : 0.00);
        for (let i = 1; i <= items; i++) {
            total += parseFloat($('#price_' + i).val() ? $('#price_' + i).val() : 0.00);
        }
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
