@extends('admin.pages.track')

@section('more-js')
<!-- <script type="text/javascript" src="{{ asset('js/admin/search.js') }}"></script>
<script type="text/javascript">
	$("#upcoming-search").keyup(function() {
		search("upcoming-search", "upcoming-table", 1);
	});
	$("#past-search").keyup(function() {
		search("past-search", "past-table", 1);
	});
</script> -->
@endsection

@section('dashboard-content')
@foreach($tracks as $track)
<div class="card mb-3">
	<div class="card-header">
		<form action="{{ route('admin.tracks.destroy', ['id' => $track->track_id]) }}" method="POST">
			<input hidden type="hidden" name="_method" value="DELETE" />
			{!! csrf_field() !!}
			<div>
				<i class="fas fa-table" style="padding-top: 10px;"></i>
				Track {{ $track->number }} - {{ $track->topic }}
				<div style="float: right;">
					<a class="btn btn-primary" href="{{ route('admin.tracks.edit', ['id' => $track->track_id]) }}">EDIT</a>
					<button type="submit" class="btn btn-danger">DELETE</button>
				</div>
			</div>
		</form>
	</div>
	<div class="card-body">

		<!-- <div class="input-group mb-3">
			<input id="upcoming-search" type="text" class="form-control" placeholder="Search keyword">
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="button">
					<i class="fas fa-search"></i>
				</button>
			</div>
		</div> -->

		<form method="POST" action="{{ route('admin.speakers.store') }}" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="input-group mb-3">
				<input id="name" name="name" class="form-control" type="text" placeholder="Name" required/>
				<input id="position" name="position" class="form-control" type="text" placeholder="Position" required/>
				<input id="company" name="company" class="form-control" type="text" placeholder="Company" required/>
				<div class="input-group-append">
					<button class="btn btn-primary btn-md" type="submit">ADD</button>
				</div>
			</div>
			<input id="event_id" name="event_id" class="form-control" type="number" value="{{ $track->event_id }}" hidden required/>
			<input id="track_id" name="track_id" class="form-control" type="number" value="{{ $track->track_id }}" hidden required/>
			<!-- <div class="form-group row">
				<label for="name" class="col-sm-2 col-form-label">Name</label>
				<div class="col-sm-10">
					<input id="name" name="name" class="form-control" type="text" placeholder="Name" required/>
				</div>
			</div>
			<div class="form-group row">
				<label for="position" class="col-sm-2 col-form-label">Position</label>
				<div class="col-sm-10">
					<input id="position" name="position" class="form-control" type="text" placeholder="Position" required/>
				</div>
			</div>
			<div class="form-group row">
				<label for="company" class="col-sm-2 col-form-label">Company</label>
				<div class="col-sm-10">
					<input id="company" name="company" class="form-control" type="text" placeholder="Company" required/>
				</div>
			</div> -->
			<!-- <div class="form-group row">
				<label for="media" class="col-sm-2 col-form-label"></label>
				<div class="col-sm-10">
					<button class="btn btn-primary btn-md" type="submit">ADD</button>
				</div>
			</div> -->
		</form>

		<div class="table-responsive">
			<table class="table table-bordered" id="speaker-table" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th class="align-middle">No</th>
						<th class="align-middle">Name</th>
						<th class="align-middle">Position</th>
						<th class="align-middle">Company</th>
						<th class="align-middle">Created At</th>
						<th class="align-middle">Updated At</th>
						<th class="align-middle">Actions</th>
					</tr>
				</thead>
				<?php $counter = 1; ?>
				<tbody>
					@foreach($track->speakers as $speaker)
					<tr>
						<td class="text-center">{{ $counter++ }}</td>
						<td class="cell-md">{{ $speaker->name }}</td>
						<td class="cell-md">{{ substr($speaker->position, 0, 50) }}{{ strlen($speaker->position) > 100 ? '....' : '' }}</td>
						<td class="cell-max">{{ $speaker->company }}</td>
						<td class="cell-max">{{ $speaker->created_at }}</td>
						<td class="cell-max">{{ $speaker->updated_at }}</td>
						<td class="cell-max">
							<form action="{{ route('admin.speakers.archive', ['id' => $speaker->speaker_id, 'event_id' => $track->event_id]) }}" method="POST">
								<input hidden type="hidden" name="_method" value="DELETE" />
								{!! csrf_field() !!}
								<div class="button-group" role="group">
									<a class="btn btn-primary" href="{{ route('admin.speakers.change', ['id' => $speaker->speaker_id, 'event_id' => $track->event_id]) }}">EDIT</a>
									<button type="submit" class="btn btn-danger">DELETE</button>
								</div>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
@endforeach
@endsection
