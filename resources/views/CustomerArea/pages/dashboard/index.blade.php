@extends('CustomerArea.layouts.app')

@section('header')
<div class="page-header">
    <h4 class="page-title">Dashboard</h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="#">
                <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Base</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Dashboard</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                    <a href="{{ route('admin.index') }}">
                        <img src="{{ asset('assets/img/avatar.png')  }}" alt="Profile Image" class="rounded-circle"
                            width="100%">
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="text-center mt-3">
                <h3 class="text-center">Hey! <strong>{{ Auth::user()->name }}</strong></h3>
                <h5 class="text-center">Welcome to Customer Dashboard</h5>
            </div>
        </div>
    </div>
</div>
@endsection
