@extends('mail.master')

@section('title', 'Registration Email')

@section('content')
<div class="row" style="margin-top: 35px;">
    <p class="col-12">{{ $data->content }}</p>
</div>
<div class="row">
    <div class="col-12 text-center">
        <img class="qrcode" src="{{ $path }}" alt="qr_code">
    </div>
    <div class="col-12">
        <div class="row">
            <h5 class="col-12"><small>Registrant Data</small></h5>
        </div>
        <div class="row">
            <p class="col-xs-12 col-sm-6">Name : </p>
            <p class="col-xs-12 col-sm-6"><b>{{ $data->name }}</b></p>
        </div>
        <div class="row">
            <p class="col-xs-12 col-sm-6">Company : </p>
            <p class="col-xs-12 col-sm-6"><b>{{ $data->company }}</b></p>
        </div>
        <div class="row">
            <p class="col-xs-12 col-sm-6">Event : </p>
            <p class="col-xs-12 col-sm-6"><b>{{ $data->title }}</b></p>
        </div>
        <div class="row">
            <h5 class="col-12"><small>Login Account</small></h5>
        </div>
        <div class="row">
            <p class="col-xs-12 col-sm-6">Username : </p>
            <p class="col-xs-12 col-sm-6"><b>{{ $username }}</b></p>
        </div>
        <div class="row">
            <p class="col-xs-12 col-sm-6">Password : </p>
            <p class="col-xs-12 col-sm-6"><b>{{ $password }}</b></p>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <form role="form" method="POST" action="{{ url('/registrant/login') }}">
                    {{ csrf_field() }}
                    <input id="email" class="form-control login-field" type="text" name="email" value="{{ $username }}" hidden>
                    <input id="password" class="form-control login-field" type="password" name="password" value="{{ $password }}" hidden>
                    <button type="submit" class="btn btn-inverse btn-large">LOGIN</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <h5 class="col-12"><small>Lokasi Kegiatan</small></h5>
    <p class="col-12">{{ $data->location }}</p>
</div>
@endsection
