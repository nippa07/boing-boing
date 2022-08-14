@extends('CustomerArea.layouts.app')

@section('header')
<div class="page-header">
    <h4 class="page-title">View Order</h4>
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
            <a href="{{route('customer.orders.all')}}">Orders</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="javscript:void(0)">View Order</a>
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
                    <div class="col-lg-12 text-right">
                        <div class="form-group">
                            <a class="btn btn-sm btn-primary" href="{{route('public.pdf.download', $order->id)}}"
                                data-toggle="tooltip" title="Download As PDF">
                                <i class="fa fa-download"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" target="_blank"
                                href="{{route('public.pdf.print', $order->id)}}" data-toggle="tooltip" title="Print">
                                <i class="fa fa-print"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">First Name</label>
                            <input id="first_name" type="text" name="first_name"
                                class="form-control form-control-alternative" value="{{$order->first_name}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Last Name</label>
                            <input id="last_name" type="text" name="last_name" class="form-control
                                        form-control-alternative" value="{{$order->last_name}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input id="email" type="email" name="email" class="form-control form-control-alternative"
                                value="{{$order->email}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Phone</label>
                            <input type="text" name="phone" class="form-control form-control-alternative"
                                pattern="[0-9]*" value="{{$order->phone}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="name">Company</label>
                            <input id="company" type="text" name="company" class="form-control form-control-alternative"
                                value="{{$order->company}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="name">Address</label>
                            <input id="address" type="text" name="address" class="form-control form-control-alternative"
                                value="{{$order->address}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">City</label>
                            <input id="city" type="text" name="city" class="form-control form-control-alternative"
                                value="{{$order->city}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Postal Code</label>
                            <input id="postal_code" type="text" name="postal_code"
                                class="form-control form-control-alternative" value="{{$order->postal_code}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Country</label>
                            <select class="form-control" name="country" id="country" disabled>
                                <option></option>
                                @foreach($countries as $sn => $country)
                                @if ($sn == "AU")
                                <option value="{{ $sn }}" {{$order->country == $sn? 'selected':''}}>{{ $country }}
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
                                <option value="{{ $sn }}" {{$order->state == $sn? 'selected':''}}>{{ $state }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <hr>
                        <div class="form-group">
                            <h3> <strong>Items</strong></h3>
                        </div>
                    </div>
                    @if ($order->quote)
                    @foreach ($order->quote->quote_item as $key => $item)
                    <div class="col-lg-12">
                        <div class="form-group">
                            <h6><strong>Item {{$key+1}}</strong></h6>
                            <label for="name">Name</label>
                            <input id="name" type="text" name="name[]" class="form-control form-control-alternative"
                                value="{{$item->name}}" readonly>
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
                            <input id="price" type="number" name="price[]" step="any"
                                class="form-control form-control-alternative" value="{{$item->price}}" readonly>
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
                    @endif
                    <div class="col-lg-12 mt-3">
                        <hr>
                        <div class="form-group">
                            <h3> <strong>Discounts</strong></h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Discount Percentage</label>
                            <select class="form-control" name="discount" id="discount" disabled>
                                <option></option>
                                <option value="20" {{$order->quote->discount == 20 ? 'selected':''}}>
                                    20%
                                </option>
                                <option value="25" {{$order->quote->discount == 25 ? 'selected':''}}>
                                    25%
                                </option>
                                <option value="30" {{$order->quote->discount == 30 ? 'selected':''}}>
                                    30%
                                </option>
                                <option value="50" {{$order->quote->discount == 50 ? 'selected':''}}>
                                    50%
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
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
        var sel_state = "{{$order->state}}";
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

</script>
@endsection
