@extends('PublicArea.layouts.app')

@section('content')
<div class="container">
    <div class="row py-4 justify-content-center">
        <div class="col-lg-9 mt-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <img src="{{asset('PublicArea/img/logo.webp')}}" alt="logo" style="max-width: 15rem;">
                    </h5>
                    <form action="{{ route('public.store.custom.offer') }}" class="mt-4" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">First Name<sup class="text-danger">*</sup></label>
                                    <input id="first_name" type="text" name="first_name"
                                        class="form-control form-control-alternative" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Last Name<sup class="text-danger">*</sup></label>
                                    <input id="last_name" type="text" name="last_name" class="form-control
                                        form-control-alternative" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Email<sup class="text-danger">*</sup></label>
                                    <input id="email" type="email" name="email"
                                        class="form-control form-control-alternative" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Phone<sup class="text-danger">*</sup></label>
                                    <input type="text" name="phone" class="form-control form-control-alternative"
                                        pattern="[0-9]*" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Sticker Size<sup class="text-danger">*</sup></label>
                                    <input type="number" name="sticker_size"
                                        class="form-control form-control-alternative"
                                        placeholder="Size in millimetres (mm)" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Material<sup class="text-danger">*</sup></label>
                                    <select class="form-control" name="material" id="material" required>
                                        <option value="{{\App\Models\QuoteRequest::MATERIAL['GLOSS']}}">Gloss</option>
                                        <option value="{{\App\Models\QuoteRequest::MATERIAL['MATTE']}}">Matte</option>
                                        <option value="{{\App\Models\QuoteRequest::MATERIAL['CLEAR']}}">Clear
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Sticker Shape<sup class="text-danger">*</sup></label>
                                    <select class="form-control" name="sticker_shape" id="sticker_shape" required>
                                        <option value="{{\App\Models\QuoteRequest::STICKER_SHAPE['SQUARE']}}">
                                            Square
                                        </option>
                                        <option value="{{\App\Models\QuoteRequest::STICKER_SHAPE['CIRCLE']}}">
                                            Circle
                                        </option>
                                        <option value="{{\App\Models\QuoteRequest::STICKER_SHAPE['OVAL']}}">
                                            Oval
                                        </option>
                                        <option value="{{\App\Models\QuoteRequest::STICKER_SHAPE['RECTANGLE']}}">
                                            Rectangle
                                        </option>
                                        <option value="{{\App\Models\QuoteRequest::STICKER_SHAPE['CUSTOM']}}">
                                            Custom
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Finishing<sup class="text-danger">*</sup></label>
                                    <select class="form-control" name="finishing" id="finishing" required>
                                        <option value="{{\App\Models\QuoteRequest::FINISHING['SHEETS']}}">
                                            Sheets
                                        </option>
                                        <option value="{{\App\Models\QuoteRequest::FINISHING['INDIVIDUAL']}}">
                                            Individual
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Quantity<sup class="text-danger">*</sup></label>
                                    <input type="number" name="quantity" class="form-control form-control-alternative"
                                        required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="control-group" id="artwork">
                                        <label class="control-label" for="field1">
                                            Upload Your Artwork Here
                                        </label>
                                        <div class="controls">
                                            <div class="entry input-group upload-input-group">
                                                <input class="form-control" name="artwork[]" type="file">
                                                <button class="btn btn-upload btn-success btn-add" type="button">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="form-group">
                                    <label for="name">Additional Details</label>
                                    <textarea class="form-control" name="details" rows="3"></textarea>
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
{{-- @include('PublicArea.pages.test.assets.css') --}}
@endsection

@section('js')
<script>
    $(function () {
        $(document).on('click', '.btn-add', function (e) {
            e.preventDefault();

            var controlForm = $('.controls:first'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(controlForm);

            newEntry.find('input').val('');
            controlForm.find('.entry:not(:last) .btn-add')
                .removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<span class="fa fa-trash"></span>');
        }).on('click', '.btn-remove', function (e) {
            $(this).parents('.entry:first').remove();

            e.preventDefault();
            return false;
        });
    });

</script>

@endsection
