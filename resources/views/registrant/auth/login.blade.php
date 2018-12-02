@extends('layout.master')

@section('title', 'Login')

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="bg-green">
    <div class="container">
        <div class="row full-height">
            <div class="col-12 login-panel align-self-center center">
                <h5 class=""><small>Login</small></h5>
                <form class="login-form" role="form" method="POST" action="{{ url('/registrant/login') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input id="email" class="form-control login-field" type="text" name="email" value="{{ old('email') }}" placeholder="Email">
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                        <label for="email" class="login-field-icon fui-user"></label>
                    </div>
                    <div class="form-group">
                        <input id="password" class="form-control login-field" type="password" name="password" placeholder="Password">
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                        <label for="password" class="login-field-icon fui-lock"></label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
                    <a href="{{ url('/registrant/password/reset') }}" class="login-link">Forgot password</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
