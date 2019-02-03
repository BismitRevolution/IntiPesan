@extends('mail.master')

@section('title', 'Registration Email')

@section('content')
<div class="row" style="margin-top: 35px;">
    <p class="col-12">{{ $data->content }}</p>
</div>
@endsection
