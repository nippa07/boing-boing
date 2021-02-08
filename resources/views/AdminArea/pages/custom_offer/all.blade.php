@extends('AdminArea.layouts.app')

@section('header')
<div class="page-header">
    <h4 class="page-title">Custom Offer Requests</h4>
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
            <a href="javscript:void(0)">Custom Offer Requests</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="groups" class="display table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Created At</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($custom_offers as $key => $custom_offer)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    <span>{{$custom_offer->first_name}}&nbsp;{{$custom_offer->last_name}}</span><br>
                                    <span class="badge badge-dark">{{$custom_offer->email}}</span>
                                </td>
                                <td>{{$custom_offer->phone}}</td>
                                <td>{{$custom_offer->created_at}}</td>
                                <td class="text-left">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-dark" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item"
                                                href="{{route('admin.custom.offer.view', $custom_offer->id)}}">
                                                <i class="fa fa-eye text-primary"></i>&nbsp;View
                                            </a>
                                            <div class="dropdown-divider responsive-moblile"></div>
                                            <a class="dropdown-item"
                                                href="{{route('admin.offer.quote.add', $custom_offer->id)}}">
                                                <i class="fa fa-paper-plane text-secondary"></i>&nbsp;Send Quote
                                            </a>
                                            <div class="dropdown-divider responsive-moblile"></div>
                                            <a class="dropdown-item delete-group" data-id="{{$custom_offer->id}}"
                                                href="javascript:void(0)">
                                                <i class="fa fa-trash text-danger"></i>&nbsp;Delete
                                            </a>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#groups').DataTable({
            language: {
                paginate: {
                    next: '<i class="fas fa-chevron-right"></i>',
                    previous: '<i class="fas fa-chevron-left"></i>'
                }
            }
        });
    });

    $(".delete-group").on('click', function () {
        var id = $(this).attr('data-id');

        swal({
            title: 'Are you sure?',
            text: "This will permanently delete this user!",
            type: 'warning',
            buttons: {
                confirm: {
                    text: 'Yes, delete it!',
                    className: 'btn btn-success'
                },
                cancel: {
                    visible: true,
                    text: 'No, cancel!',
                    className: 'btn btn-danger'
                }
            }
        }).then((willDelete) => {
            if (willDelete) {
                window.location.href = '{{ url("admin/custom/offer/delete") }}/' + id;
            }
        });
    });

</script>
@endsection
