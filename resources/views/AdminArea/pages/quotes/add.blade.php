@extends('AdminArea.layouts.app')

@section('header')
<div class="page-header">
    <h4 class="page-title">Send Offer Quote</h4>
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
            <a href="javscript:void(0)">Send Offer Quote</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.offer.quote.store') }}" method="post">
                    <div class="row justify-content-center">
                        @csrf
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">First Name</label>
                                <input id="first_name" type="text" name="first_name"
                                    class="form-control form-control-alternative"
                                    value="{{$custom_offer?$custom_offer->first_name:''}}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Last Name</label>
                                <input id="last_name" type="text" name="last_name" class="form-control
                                        form-control-alternative" value="{{$custom_offer?$custom_offer->last_name:''}}"
                                    required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input id="email" type="email" name="email"
                                    class="form-control form-control-alternative"
                                    value="{{$custom_offer?$custom_offer->email:''}}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Phone</label>
                                <input id="phone" type="text" name="phone" class="form-control form-control-alternative"
                                    pattern="[0-9]*" value="{{$custom_offer?$custom_offer->phone:''}}" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="name">Company</label>
                                <input id="company" type="text" name="company"
                                    class="form-control form-control-alternative">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="name">Address</label>
                                <input id="address" type="text" name="address"
                                    class="form-control form-control-alternative">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">City</label>
                                <input id="city" type="text" name="city" class="form-control form-control-alternative">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Postal Code</label>
                                <input id="postal_code" type="text" name="postal_code"
                                    class="form-control form-control-alternative">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Country</label>
                                <select class="form-control" onchange="getStates()" name="country" id="country"
                                    required>
                                    <option></option>
                                    @foreach($countries as $sn => $country)
                                    @if ($sn == "AU")
                                    <option value="{{ $sn }}" {{$sn == "AU"? 'selected':''}}>{{ $country }}</option>
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
                                    <option value="{{ $sn }}">{{ $state }}</option>
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
                        <div class="col-lg-12 mt-2">
                            <hr>
                            <div class="form-group">
                                <h3> <strong>Add Items</strong></h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <h6><strong>Item 1</strong></h6>
                                <label for="name">Sticker Type</label>
                                <select class="form-control" name="type[]" id="type" required>
                                    <option></option>
                                    <option value="{{\App\Models\QuoteItem::TYPE['BUMPER_STICKERS']}}">
                                        Bumper Stickers
                                    </option>
                                    <option value="{{\App\Models\QuoteItem::TYPE['VINYL_STICKERS']}}">
                                        Vinyl Stickers
                                    </option>
                                    <option value="{{\App\Models\QuoteItem::TYPE['CLEAR_VINYL_STICKERS']}}">
                                        Clear Vinyl Stickers
                                    </option>
                                    <option
                                        value="{{\App\Models\QuoteItem::TYPE['CLEAR_VINYL_STICKERS_WITH_WHITE_INK']}}">
                                        Clear Vinyl Stickers With White INK
                                    </option>
                                    <option value="{{\App\Models\QuoteItem::TYPE['HIGH_TRACK_STICKERS']}}">
                                        High Tack Stickers
                                    </option>
                                    <option value="{{\App\Models\QuoteItem::TYPE['BLOCKOUT_VINYL_STICKERS']}}">
                                        Blockout Vinyl
                                        Stickers</option>
                                    <option value="{{\App\Models\QuoteItem::TYPE['GOLD_SILVER_VINYL_STICKERS']}}">
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
                                    <option value="{{\App\Models\QuoteItem::TURNAROUND_TIME['1_2_DAYS']}}">
                                        1-2 Days
                                    </option>
                                    <option value="{{\App\Models\QuoteItem::TURNAROUND_TIME['2_3_DAYS']}}">
                                        2-3 Days
                                    </option>
                                    <option value="{{\App\Models\QuoteItem::TURNAROUND_TIME['3_5_DAYS']}}">
                                        3-5 Days
                                    </option>
                                    <option value="{{\App\Models\QuoteItem::TURNAROUND_TIME['5_7_DAYS']}}">
                                        5-7 Days
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Quantity</label>
                                <input id="quantity" type="number" name="quantity[]" min="1"
                                    class="form-control form-control-alternative" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Price</label>
                                <input id="price_1" type="number" name="price[]" step="any" min="0"
                                    class="form-control form-control-alternative" oninput=loadCost() required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Finishing</label>
                                <select class="form-control" name="finishing[]" id="finishing" required>
                                    <option></option>
                                    <option value="{{\App\Models\QuoteItem::FINISHING['SHEETS']}}">
                                        Sheets
                                    </option>
                                    <option value="{{\App\Models\QuoteItem::FINISHING['INDIVIDUALS']}}">
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
                                    <option value="{{\App\Models\QuoteItem::VINYL_TYPE['GLOSS']}}">
                                        Gloss
                                    </option>
                                    <option value="{{\App\Models\QuoteItem::VINYL_TYPE['MATTE']}}">
                                        Matte
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Sticker Size</label>
                                <input id="sticker_size" type="text" name="sticker_size[]"
                                    class="form-control form-control-alternative" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Corners</label>
                                <select class="form-control" name="corners[]" id="corners" required>
                                    <option></option>
                                    <option value="{{\App\Models\QuoteItem::CORNERS['NONE']}}">
                                        None
                                    </option>
                                    <option value="{{\App\Models\QuoteItem::CORNERS['SQUARE']}}">
                                        Square
                                    </option>
                                    <option value="{{\App\Models\QuoteItem::CORNERS['ROUNDED']}}">
                                        Rounded
                                    </option>
                                    <option value="{{\App\Models\QuoteItem::CORNERS['CUSTOM_SHAPE']}}">
                                        Custom Shape
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="name">Description</label>
                                <textarea class="form-control" name="description[]" rows="3"></textarea>
                            </div>
                        </div>
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
                                    <option value="20">
                                        20%
                                    </option>
                                    <option value="25">
                                        25%
                                    </option>
                                    <option value="30">
                                        30%
                                    </option>
                                    <option value="50">
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
                                    <strong>Discounts:</strong>&nbsp;<span id="discounts">0%</span>
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
                                <input type="hidden" name="quote_request_id"
                                    value="{{$custom_offer?$custom_offer->id:''}}">
                                <button type="submit" class="btn btn-success">
                                    Send Quote
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
    var items = 1;

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
        $('#finishing').select2({
            placeholder: "Select Finishing",
            theme: "bootstrap"
        });
        $('#vinyl_type').select2({
            placeholder: "Select Type of Vinyl",
            theme: "bootstrap"
        });
        $('#corners').select2({
            placeholder: "Select Corner",
            theme: "bootstrap"
        });
        $('#discount').select2({
            placeholder: "Select Discount",
            theme: "bootstrap"
        });
        getStates();
    });

    function getStates(sel_state = null) {
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
                    html += "<option value='" + key + "'" + (sel_state && sel_state == key ?
                            'selected' : '') + ">" +
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
        if (items != 1) {
            $('.item_' + items).html('');
            items--;
        }
    }

    $('#email').on('input', function () {
        var email = $(this).val();

        autoFill(email);
    });

    function autoFill(email) {
        $.ajax({
            url: "{{ route('admin.offer.quote.get.mail') }}?email=" + email,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            success: function (response) {
                if (response) {
                    $('#first_name').val(response.first_name);
                    $('#last_name').val(response.last_name);
                    $('#phone').val(response.phone);
                    $('#company').val(response.company);
                    $('#address').val(response.address);
                    $('#city').val(response.city);
                    $('#postal_code').val(response.postal_code);
                    getStates(response.state);
                }
            }
        });
    }

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
        $('#discounts').html(discount+"%");
        $('#gst').html("$" + (Math.round(gst * 100) / 100).toFixed(2));
        $('#g_total').html("$" +
            (Math.round(g_total * 100) / 100).toFixed(2));
    }

</script>
@endsection
