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
                            @php
                            $total = number_format(array_sum($item_total) + $quote->shipping_amount +
                            ((array_sum($item_total) + $quote->shipping_amount) * (10/100)), 2);
                            @endphp
                            <tr>
                                <th>
                                    Shipping:
                                </th>
                                <td>
                                    ${{number_format($quote->shipping_amount, 2)}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Sub-Total:
                                </th>
                                <td>
                                    ${{number_format(array_sum($item_total) + $quote->shipping_amount, 2)}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    GST:
                                </th>
                                <td>
                                    ${{number_format((array_sum($item_total) + $quote->shipping_amount) * (10/100), 2)}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Total:
                                </th>
                                <td>
                                    ${{$total}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mt-4">
            <form id="payment-form" action="{{route('public.quote.checkout.save')}}" class="validation"
                data-cc-on-file="false" method="POST"
                data-stripe-publishable-key="{{ config('paymentgateways.stripe.key') }}">
                @csrf
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <img src="{{asset('PublicArea/img/logo.webp')}}" alt="logo" style="max-width: 15rem;">
                        </h5>
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
                                        @if ($sn == "AU")
                                        <option value="{{ $sn }}"
                                            {{$quote && $sn == $quote->country ? 'selected':($sn == "AU"? 'selected':'')}}>
                                            {{ $country }}
                                        </option>
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
                        </div>
                    </div>
                </div>
                <div class="card shadow mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Payment</h5>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input class="payment_type" type="radio" class="form-check-input" name="payment_type"
                                    value="{{\App\Models\Order::PAYMENT_TYPE['PAYPAL']}}" required>Paypal&nbsp;
                                <img src="{{asset('PublicArea/img/paypal.webp')}}" alt="paypal"
                                    style="max-width: 16rem;">
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input class="payment_type" type="radio" class="form-check-input" name="payment_type"
                                    value="{{\App\Models\Order::PAYMENT_TYPE['STRIPE']}}" required>Credit
                                Cards &nbsp;
                                <img src="{{asset('PublicArea/img/amex.svg')}}" alt="amex" style="max-width: 4rem">
                                <img src="{{asset('PublicArea/img/discover.svg')}}" alt="discover"
                                    style="max-width: 4rem">
                                <img src="{{asset('PublicArea/img/visa.svg')}}" alt="visa" style="max-width: 4rem">
                                <img src="{{asset('PublicArea/img/mastercard.svg')}}" alt="mastercard"
                                    style="max-width: 4rem">
                            </label>
                        </div>
                        <div id="stripe_content" class="row mt-4 d-none">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Name on Card<sup class="text-danger">*</sup></label>
                                    <input id="card_name" type="text" name="card_name"
                                        class="form-control form-control-alternative">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Card Number<sup class="text-danger">*</sup></label>
                                    <input id="card_number" type="text" name="card_number"
                                        class="form-control form-control-alternative">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">Expiration Month<sup class="text-danger">*</sup></label>
                                    <input id="card_expiry_month" type="number" name="card_expiry_month"
                                        placeholder='MM' class="form-control form-control-alternative">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">Expiration Year<sup class="text-danger">*</sup></label>
                                    <input id="card_expiry_year" type="number" name="card_expiry_year"
                                        placeholder='YYYY' class="form-control form-control-alternative">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">CVC<sup class="text-danger">*</sup></label>
                                    <input id="card_cvc" type="number" name="card_cvc" placeholder='e.g - 415'
                                        class="form-control form-control-alternative">
                                </div>
                            </div>
                        </div>
                        <div id="paypal_content" class="row d-none">

                        </div>
                        <div class="row mt-5">
                            <div class="col-lg-12 text-center">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="conditions" required>
                                    <label class="form-check-label" for="conditions">
                                        I accept all Boing Boing Stickers <a target="_blank"
                                            href="https://boingboing.com.au/terms/">Terms and
                                            Conditions</a> and I have read the <a target="_blank"
                                            href="https://boingboing.com.au/privacy-policy/">Privacy
                                            Policy</a>.
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-12 text-center">
                                <div class="form-group">
                                    <input type="hidden" name="total_amount" value="{{$total}}">
                                    <input type="hidden" name="quote_id" value="{{$quote->id}}">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
    var payment_type = 1;

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

    $('.payment_type').on('click', function () {
        payment_type = this.value;

        if (payment_type == "{{\App\Models\Order::PAYMENT_TYPE['PAYPAL']}}") {
            $('#paypal_content').removeClass('d-none');
            $('#stripe_content').addClass('d-none');
            validateStripe(false);

        } else {
            $('#stripe_content').removeClass('d-none');
            $('#paypal_content').addClass('d-none');

            validateStripe(true);
        }
    });

    function validateStripe(state) {
        $('#card_name').attr('required', state);
        $('#card_number').attr('required', state);
        $('#card_expiry_month').attr('required', state);
        $('#card_expiry_year').attr('required', state);
        $('#card_cvc').attr('required', state);
    }
    $(function () {
        var $form = $(".validation");

        $('form.validation').bind('submit', function (e) {
            if (payment_type != "{{\App\Models\Order::PAYMENT_TYPE['PAYPAL']}}") {

                var $form = $(".validation"),
                    valid = true;

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('#card_number').val(),
                        exp_month: $('#card_expiry_month').val(),
                        exp_year: $('#card_expiry_year').val(),
                        cvc: $('#card_cvc').val()
                    }, stripeHandleResponse);
                }
            }

        });

        function stripeHandleResponse(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                $form.get(0).submit();
            }
        }

    });

</script>
@endsection
