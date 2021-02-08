@extends('PublicArea.layouts.app')

@section('content')
<div class="container">
    <div class="row py-4 justify-content-center">
        <div class="col-lg-6 mt-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        Your Order
                    </h5>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quote->quote_item as $key => $item)
                            @php
                            $item_total[$key] = ($item->price *
                            $item->quantity);
                            @endphp
                            <tr class="item_tr">
                                <td>
                                    {{$item->name}} <br>
                                    {{$item->description}}
                                </td>
                                <td>
                                    ${{number_format($item_total[$key], 2)}}
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <th>
                                    Sub-Total:
                                </th>
                                <td>
                                    ${{number_format(array_sum($item_total), 2)}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    GST:
                                </th>
                                <td>
                                    ${{number_format(array_sum($item_total) * (10/100), 2)}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Total:
                                </th>
                                <td>
                                    ${{number_format(array_sum($item_total) + (array_sum($item_total) * (10/100)), 2)}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mt-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <img src="{{asset('PublicArea/img/logo.webp')}}" alt="logo" style="max-width: 15rem;">
                    </h5>
                    <form action="" class="mt-4" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">First Name<sup class="text-danger">*</sup></label>
                                    <input id="first_name" type="text" name="first_name"
                                        class="form-control form-control-alternative"
                                        value="{{$quote ?$quote->first_name:''}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Last Name<sup class="text-danger">*</sup></label>
                                    <input id="last_name" type="text" name="last_name" class="form-control
                                        form-control-alternative" value="{{$quote ?$quote->last_name:''}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Email<sup class="text-danger">*</sup></label>
                                    <input id="email" type="email" name="email" class="form-control
                                        form-control-alternative" value="{{$quote ?$quote->email:''}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Phone<sup class="text-danger">*</sup></label>
                                    <input type="text" name="phone" class="form-control form-control-alternative"
                                        pattern="[0-9]*" value="{{$quote ?$quote->phone:''}}" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name">Company</label>
                                    <input id="company" type="text" name="company" class="form-control
                                        form-control-alternative" value="{{$quote ?$quote->company:''}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name">Address</label>
                                    <input id="address" type="text" name="address" class="form-control
                                        form-control-alternative" value="{{$quote ?$quote->address:''}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">City</label>
                                    <input id="city" type="text" name="city" class="form-control
                                        form-control-alternative" value="{{$quote ?$quote->city:''}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Postal Code</label>
                                    <input id="postal_code" type="text" name="postal_code"
                                        class="form-control form-control-alternative"
                                        value="{{$quote ?$quote->postal_code:''}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Country</label>
                                    <select class="form-control" onchange="getStates()" name="country" id="country"
                                        required>
                                        <option></option>
                                        @foreach($countries as $sn => $country)
                                        <option value="{{ $sn }}"
                                            {{$quote && $sn == $quote->country ? 'selected':($sn == "AU"? 'selected':'')}}>
                                            {{ $country }}
                                        </option>
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
                                        <option value="{{ $sn }}" {{$quote && $sn == $quote->state ? 'selected':''}}>
                                            {{ $state }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="form-group">
                                    <label for="name">Order notes (optional)</label>
                                    <textarea class="form-control" name="notes" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3 text-center">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    @media (min-width: 1200px) {

        .container,
        .container-lg,
        .container-md,
        .container-sm,
        .container-xl {
            max-width: 1340px;
        }
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

</script>
@endsection
