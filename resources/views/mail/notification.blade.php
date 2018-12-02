@extends('mail.master')

@section('title', 'Registration Email')

@section('content')
<div class="row" style="margin-top: 35px;">
    <p class="col-12">{{ $data->content }}</p>
</div>
<div class="row">
    <h5 class="col-12"><small>Lokasi Kegiatan</small></h5>
    <p class="col-12">{{ $data->location }}</p>
</div>
@endsection
