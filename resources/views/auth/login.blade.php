@extends('auth.layouts.app')

@section('content')
<div class="container container-login animated fadeIn">
    <h3 class="text-center">Sign In</h3>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="login-form">
            <div class="form-group form-floating-label">
                <input id="email" name="email" type="email"
                    class="form-control input-border-bottom @error('email') is-invalid @enderror"
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
            <div class="row form-sub m-0">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="rememberme">
                    <label class="custom-control-label" for="rememberme">Remember Me</label>
                </div>

                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="link float-right">Forget Password?</a>
                @endif
            </div>
            <div class="form-action mb-3">
                <button type="submit" class="btn btn-primary btn-rounded btn-login">Sign In</button>
            </div>
            <div class="login-account">
                <span class="msg">Don't have an account yet ?</span>
                <a href="{{ route('register') }}" class="link">Sign Up</a>
            </div>
        </div>
    </form>
</div>
@endsection
