@extends('mail.master')

@section('title', 'Registration Email')

@section('content')
<div class="row">
    <div class="col-12 col-md-6">
        <div class="row">
            <h5 class="col-12"><small>Login Account</small></h5>
        </div>
        <div class="row">
            <p class="col-xs-6 col-sm-6">Username : </p>
            <p class="col-xs-6 col-sm-6"><b>{{ $username }}</b></p>
        </div>
        <div class="row">
            <p class="col-xs-6 col-sm-6">Password : </p>
            <p class="col-xs-6 col-sm-6"><b>{{ $password }}</b></p>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <a class="btn btn-inverse btn-large" href="{{ route('registrant.login') }}">LOGIN</a>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <img class="float-right qrcode" src="{{ $path }}" alt="qr_code">
    </div>
</div>
<div class="row" style="margin-top: 35px;">
    <p>{{ $data->content }}</p>
</div>
<div class="row">
    <h5><small>Lokasi Kegiatan</small></h5>
    <p>{{ $data->location }}</p>
</div>
@endsection
