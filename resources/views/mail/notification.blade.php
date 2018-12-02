@extends('mail.master')

@section('title', 'Registration Email')

@section('content')
<div class="row" style="margin-top: 35px;">
    <p>{{ $data->content }}</p>
</div>
<div class="row">
    <h5><small>Lokasi Kegiatan</small></h5>
    <p>{{ $data->location }}</p>
</div>
@endsection
