@extends('layout/master')

@section('title', 'Homepage')

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/pages/index.css') }}">
@endsection

@section('content')
<div id="home" class="bg-green white">
    <div class="container-app row full-height align-items-center">
        <div class="col-12 col-md-6">
            <h5>INTIPESAN</h5>
            <p>Administration System</p>
        </div>
        <div class="col-12 col-md-6">
            <a href="{{ route('registrant.login') }}" class="btn btn-large">USER LOGIN</a>
            <a href="{{ route('admin.login') }}" class="btn btn-large">ADMIN LOGIN</a>
        </div>
    </div>
</div>
@endsection
