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
                                <input type="text" name="phone" class="form-control form-control-alternative"
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
                                    class="form-control form-control-alternative" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">City</label>
                                <input id="city" type="text" name="city" class="form-control form-control-alternative"
                                    required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Postal Code</label>
                                <input id="postal_code" type="text" name="postal_code"
                                    class="form-control form-control-alternative" required>
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
                                <select class="form-control" id="state" name="state" required>
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
                                <label for="name">Shipping Cost</label>
                                <input id="shipping_amount" type="number" min="0" name="shipping_amount"
                                    class="form-control form-control-alternative" step="any" required>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <hr>
                            <div class="form-group">
                                <h3> <strong>Add Items</strong></h3>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <h6><strong>Item 1</strong></h6>
                                <label for="name">Name</label>
                                <input id="name" type="text" name="name[]" class="form-control form-control-alternative"
                                    required>
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
                                <input id="price" type="number" name="price[]" step="any" min="0"
                                    class="form-control form-control-alternative" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="name">Description</label>
                                <textarea class="form-control" name="description[]" rows="3" required></textarea>
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
                        <div class="col-lg-12 text-center mt-3">
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

        getStates();
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
            '<div class="col-lg-12">' +
            '<div class="form-group">' +
            '<h6><strong>Item ' + items + '</strong></h6>' +
            '<label for="name">Name</label>' +
            '<input id="name" type="text" name="name[]" class="form-control form-control-alternative" required>' +
            '</div>' +
            '</div>' +
            '<div class="row mx-0">' +
            '<div class="col-lg-6">' +
            '<div class="form-group">' +
            '<label for="name">Quantity</label>' +
            '<input id="quantity" type="number" name="quantity[]" min="1" class="form-control form-control-alternative" required>' +
            '</div>' +
            '</div>' +
            '<div class="col-lg-6">' +
            '<div class="form-group">' +
            '<label for="name">Price</label>' +
            '<input id="price" type="number" name="price[]" min="0" class="form-control form-control-alternative" step="any" required>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="col-lg-12">' +
            '<div class="form-group">' +
            '<label for="name">Description</label>' +
            '<textarea class="form-control" name="description[]" rows="3" required></textarea>' +
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

</script>
@endsection
