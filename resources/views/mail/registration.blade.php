@extends('mail.master')

@section('content')
{{ $data->content }}
@endsection

@section('map')
{{ $data->location }}
@endsection

@section('credential')
{{ $username }}
{{ $password }}
@endsection
