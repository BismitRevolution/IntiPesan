@extends('layout.master')

@section('title', 'Admin Reset Password')

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="bg-green">
    <div class="container">
        <div class="row full-height">
            <div class="col-12 login-panel align-self-center center">
                <h5 class=""><small>Admin Reset Password</small></h5>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="login-form" role="form" method="POST" action="{{ url('/admin/password/email') }}">
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
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Send Reset Request</button>
                    <!-- <a href="{{ url('/admin/password/reset') }}" class="login-link">Forgot password</a> -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
