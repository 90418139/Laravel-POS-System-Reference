@extends('layouts.app')

@section('content')
<div class="container">
    <div class="sidenav">
        <div class="login-main-text">
            <h2>{{ trans('pos.login.title') }}<br>{{ trans('pos.login.page') }}</h2>
            <p>{{ trans('pos.login.interpretation') }}</p>
        </div>
    </div>
    <div class="main">
        <div class="col-md-6 col-sm-12">
            <div class="login-form">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>{{ trans('pos.login.account') }}</label>
                        <input name="account" type="text" class="form-control @error('account') is-invalid @enderror" value="{{ old('account') }}" autocomplete="account" placeholder="{{ trans('pos.login.account') }}" required autofocus>
                        @error('account')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ trans('pos.login.password') }}</label>
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" autocomplete="current-password" placeholder="{{ trans('pos.login.password') }}" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-black">Login</button>
                    <button type="submit" class="btn btn-secondary" hidden>{{ trans('pos.login.register') }}</button>
                </form>
            </div>
        </div>
    </div>
    @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}" hidden>
            {{ __('Forgot Your Password?') }}
        </a>
    @endif

@endsection
