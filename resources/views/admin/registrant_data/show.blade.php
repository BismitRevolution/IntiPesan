@extends('main')
@section('content')
<div class="container article-post" style="margin-top:150px;">

	<div class="row">
		<div class="col-10">
			<h1>{{ $registrant->title }}</h1>
		</div>
		<div class="col-2">
			<form action="{{ route('admin.registrants.edit', ['id' => $registrant->registrant_id]) }}" method="GET">
				<button type="submit" class="btn btn-primary btn-block btn-setting">Edit Vendor</button>
			</form>
			<form action="{{ route('admin.registrants.destroy', ['id' => $registrant->registrant_id]) }}" method="POST">
				<input disabled type="hidden" name="_method" value="DELETE" />
				<button type="submit" class="btn btn-danger btn-block btn-setting">Delete Vendor</button>
				{!! csrf_field() !!}
			</form>
		</div>
	</div>
	<small>Posted on {{  date('D, j M y, h:ia', strtotime($registrant->updated_at)) }}</small>
	<hr>
	@foreach ($media as $photo)
	<a class="col-4" href="{{ url('/storage/'.$photo->path) }}" data-lightbox="{{ $registrant->title }}" data-title="{{ $registrant->title }}">
		<div style="margin: 0 auto; margin-top: 10px; width: 480px; height: 360px; background: url('/storage/{{ $photo->path }}') no-repeat center top; background-size: cover;"></div>
	</a>
	@endforeach

	<div class="row mt-1" style="overflow-x: hidden; word-wrap: break-word">
		<p>{{ $registrant->body }}</p>
	</div>
</div>
@endsection
