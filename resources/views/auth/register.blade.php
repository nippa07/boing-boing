@extends('auth.layouts.app')

@section('content')
<div class="container container-login animated fadeIn">
    <h3 class="text-center">Sign Up</h3>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="login-form">
            <div class="form-group form-floating-label">
                <input id="name" name="name" type="text"
                    class="form-control input-border-bottom @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" required>
                <label for="name" class="placeholder">Fullname</label>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group form-floating-label">
                <input id="email" name="email" type="email"
                    class="form-control input-border-bottom  @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" required>
                <label for="email" class="placeholder">Email</label>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group form-floating-label">
                <input id="password" name="password" type="password"
                    class="form-control input-border-bottom @error('password') is-invalid @enderror" required>
                <label for="password" class="placeholder">Password</label>
                <div class="show-password">
                    <i class="flaticon-interface"></i>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group form-floating-label">
                <input id="password_confirmation" name="password_confirmation" type="password"
                    class="form-control input-border-bottom" required>
                <label for="password_confirmation" class="placeholder">Confirm Password</label>
                <div class="show-password">
                    <i class="flaticon-interface"></i>
                </div>
                @error('password_confirmation')
                <span class="invalid-feedback" role="alert" style="font-size:14px;">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="form-action">
                <button type="submit" class="btn btn-primary btn-rounded btn-login">Sign Up</button>
            </div>
            <div class="login-account">
                <span class="msg">Have an account?</span>
                <a href="{{ route('login') }}" class="link">Sign In</a>
            </div>
        </div>
    </form>
</div>
@endsection
