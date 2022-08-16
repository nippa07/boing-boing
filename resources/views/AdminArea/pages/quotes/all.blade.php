@extends('AdminArea.layouts.app')

@section('header')
<div class="page-header">
    <h4 class="page-title">Offer Quotes</h4>
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
            <a href="javscript:void(0)">Offer Quotes</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <a href="{{route('admin.offer.quote.add')}}" class="btn btn-primary btn-round ml-auto">
                        <i class="fa fa-plus"></i>
                        Send New Quote
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="groups" class="display table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="max-width: 300px;">Name</th>
                                <th>Order #</th>
                                <th>Status</th>
                                <th>Sent At</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quotes as $key => $quote)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    <span>{{$quote->first_name}}&nbsp;{{$quote->last_name}}</span><br>
                                    <span class="badge badge-dark">{{$quote->email}}</span>
                                </td>
                                <td>
                                    @if ($quote->order)
                                    <a href="{{route('admin.orders.view', $quote->order->id)}}" target="blank">
                                        #{{$quote->quote_number}}
                                    </a>
                                    @else
                                    #{{$quote->quote_number}}
                                    @endif
                                </td>
                                <td>
                                    @switch($quote->status)
                                    @case(\App\Models\Quote::STATUS['SENT'])
                                    <span class="badge badge-secondary">Sent</span>
                                    @break
                                    @case(\App\Models\Quote::STATUS['ACCEPTED'])
                                    <span class="badge badge-success">Accepted</span>
                                    @break
                                    @case(\App\Models\Quote::STATUS['DECLINED'])
                                    <span class="badge badge-danger">Declined</span>
                                    @break
                                    @case(\App\Models\Quote::STATUS['ORDERED'])
                                    <span class="badge badge-primary">Ordered</span>
                                    @break
                                    @default
                                    @endswitch
                                </td>
                                <td>{{\carbon\carbon::parse($quote->created_at)->format('d/m/Y')}}</td>
                                <td class="text-left">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-dark" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item"
                                                href="{{route('admin.offer.quote.view', $quote->id)}}">
                                                <i class="fa fa-eye text-secondary"></i>&nbsp;View
                                            </a>
                                            <div class="dropdown-divider responsive-moblile">
                                            </div>
                                            <a class="dropdown-item"
                                                href="{{route('admin.offer.quote.edit', $quote->id)}}">
                                                <i class="fa fa-edit text-info"></i>&nbsp;Edit
                                            </a>
                                            <div class="dropdown-divider responsive-moblile">
                                            </div>
                                            <a class="dropdown-item"
                                                href="{{route('admin.offer.quote.send.mail', $quote->id)}}">
                                                <i class="fa fa-paper-plane text-primary"></i>&nbsp;Send Mail
                                            </a>
                                            @if ($quote->status != \App\Models\Quote::STATUS['ACCEPTED'])
                                            <div class="dropdown-divider responsive-moblile"></div>
                                            <a class="dropdown-item"
                                                href="{{route('admin.offer.quote.accept', $quote->id)}}">
                                                <i class="fa fa-check text-success"></i>&nbsp;Mark Accepted
                                            </a>
                                            @endif
                                            @if ($quote->status != \App\Models\Quote::STATUS['DECLINED'])
                                            <div class="dropdown-divider responsive-moblile"></div>
                                            <a class="dropdown-item"
                                                href="{{route('admin.offer.quote.decline', $quote->id)}}">
                                                <i class="fa fa-times text-danger"></i>&nbsp;&nbsp;Mark Declined
                                            </a>
                                            @endif
                                            @if ($quote->status != \App\Models\Quote::STATUS['ORDERED'])
                                            <div class="dropdown-divider responsive-moblile"></div>
                                            <a class="dropdown-item"
                                                href="{{route('admin.offer.quote.order', $quote->id)}}">
                                                <i class="fa fa-shopping-cart text-info"></i>&nbsp;Mark Ordered
                                            </a>
                                            @endif
                                            <div class="dropdown-divider responsive-moblile">
                                            </div>
                                            <a class="dropdown-item {{$quote->order ? 'disabled':'delete-btn'}}"
                                                data-id="{{$quote->id}}" href="javascript:void(0)">
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

    $(".delete-btn").on('click', function () {
        var id = $(this).attr('data-id');

        swal({
            title: 'Are you sure?',
            text: "This will permanently delete this quote!",
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
                window.location.href = '{{ url("admin/offer/quote/delete") }}/' + id;
            }
        });
    });

</script>
@endsection
