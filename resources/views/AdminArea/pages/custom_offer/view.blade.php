@extends('AdminArea.layouts.app')

@section('header')
<div class="page-header">
    <h4 class="page-title">View Custom Offer Request</h4>
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
            <a href="{{route('admin.custom.offer.all')}}">Custom Offer Requests</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="javscript:void(0)">View Custom Offer Request</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">First Name</label>
                            <input id="first_name" type="text" name="first_name"
                                class="form-control form-control-alternative" value="{{$custom_offer->first_name}}"
                                readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Last Name</label>
                            <input id="last_name" type="text" name="last_name" class="form-control
                                        form-control-alternative" value="{{$custom_offer->last_name}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input id="email" type="email" name="email" class="form-control form-control-alternative"
                                value="{{$custom_offer->email}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Phone</label>
                            <input type="text" name="phone" class="form-control form-control-alternative"
                                pattern="[0-9]*" value="{{$custom_offer->phone}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Sticker Size</label>
                            <input type="number" name="sticker_size" class="form-control form-control-alternative"
                                placeholder="Size in millimetres (mm)" value="{{$custom_offer->sticker_size}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Material</label>
                            <select class="form-control" name="material" id="material" disabled>
                                <option value="{{\App\Models\QuoteRequest::MATERIAL['GLOSS']}}"
                                    {{$custom_offer->material == \App\Models\QuoteRequest::MATERIAL['GLOSS'] ? 'selected':''}}>
                                    Gloss
                                </option>
                                <option value="{{\App\Models\QuoteRequest::MATERIAL['MATTE']}}"
                                    {{$custom_offer->material == \App\Models\QuoteRequest::MATERIAL['MATTE'] ? 'selected':''}}>
                                    Matte</option>
                                <option value="{{\App\Models\QuoteRequest::MATERIAL['CLEAR']}}"
                                    {{$custom_offer->material == \App\Models\QuoteRequest::MATERIAL['CLEAR'] ? 'selected':''}}>
                                    Clear
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Sticker Shape</label>
                            <select class="form-control" name="sticker_shape" id="sticker_shape" disabled>
                                <option value="{{\App\Models\QuoteRequest::STICKER_SHAPE['SQUARE']}}"
                                    {{$custom_offer->sticker_shape == \App\Models\QuoteRequest::STICKER_SHAPE['SQUARE'] ? 'selected':''}}>
                                    Square
                                </option>
                                <option value="{{\App\Models\QuoteRequest::STICKER_SHAPE['CIRCLE']}}"
                                    {{$custom_offer->sticker_shape == \App\Models\QuoteRequest::STICKER_SHAPE['CIRCLE'] ? 'selected':''}}>
                                    Circle
                                </option>
                                <option value="{{\App\Models\QuoteRequest::STICKER_SHAPE['OVAL']}}"
                                    {{$custom_offer->sticker_shape == \App\Models\QuoteRequest::STICKER_SHAPE['OVAL'] ? 'selected':''}}>
                                    Oval
                                </option>
                                <option value="{{\App\Models\QuoteRequest::STICKER_SHAPE['RECTANGLE']}}"
                                    {{$custom_offer->sticker_shape == \App\Models\QuoteRequest::STICKER_SHAPE['RECTANGLE'] ? 'selected':''}}>
                                    Rectangle
                                </option>
                                <option value="{{\App\Models\QuoteRequest::STICKER_SHAPE['CUSTOM']}}"
                                    {{$custom_offer->sticker_shape == \App\Models\QuoteRequest::STICKER_SHAPE['CUSTOM'] ? 'selected':''}}>
                                    Custom
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Finishing</label>
                            <select class="form-control" name="finishing" id="finishing" disabled>
                                <option value="{{\App\Models\QuoteRequest::FINISHING['SHEETS']}}"
                                    {{$custom_offer->finishing == \App\Models\QuoteRequest::FINISHING['SHEETS'] ? 'selected':''}}>
                                    Sheets
                                </option>
                                <option value="{{\App\Models\QuoteRequest::FINISHING['INDIVIDUAL']}}"
                                    {{$custom_offer->finishing == \App\Models\QuoteRequest::FINISHING['INDIVIDUAL'] ? 'selected':''}}>
                                    Individual
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Quantity</label>
                            <input type="number" name="quantity" class="form-control form-control-alternative"
                                value="{{$custom_offer->quantity}}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Additional Details</label>
                            <textarea class="form-control" name="details" rows="3"
                                readonly>{{$custom_offer->details}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="control-group" id="artwork">
                                <h1>Artwork</h1>
                                <div class="row mt-4">
                                    @foreach ($custom_offer->quote_request_artwork as $key =>
                                    $quote_request_artwork)
                                    <div class="col-md-6 text-center py-4">
                                        @if (in_array($quote_request_artwork->type, ['png', 'jpg', 'jpeg', 'tif',
                                        'tiff',
                                        'bmp', 'gif', 'webp']) )
                                        <a class="file_link" target="_blank"
                                            href="{{asset('uploads/'.$quote_request_artwork->name)}}"
                                            data-toggle="tooltip" title="Open in new tab">
                                            <div class="img-div">
                                                <img width=" 100%"
                                                    src="{{asset('uploads/'.$quote_request_artwork->name)}}" alt="">
                                            </div>
                                            <h4>Artwork Image {{$key+1}}</h4>
                                        </a>
                                        @else
                                        <a class="file_link" href="{{asset('uploads/'.$quote_request_artwork->name)}}"
                                            data-toggle="tooltip" title="Click to download">
                                            <div class="img-div">
                                                <img width="60%" src="{{asset('assets/img/file.png')}}" alt="">
                                            </div>
                                            <h4>Artwork Document {{$key+1}}</h4>
                                        </a>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>

                            </div>
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
