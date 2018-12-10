@extends('admin.pages.event')

@section('extra-actions')
<div class="col-xl-3 col-sm-6 mb-3">
	<div class="card text-white bg-success o-hidden h-100">
		<div class="card-body">
			<div class="card-body-icon">
				<i class="fas fa-fw fa-shopping-cart"></i>
			</div>
			<div class="mr-5">Feedback Forms</div>
		</div>
		<a class="card-footer text-white clearfix small z-1" href="{{ $event->form_url }}" target="_blank">
			<span class="float-left">FEEDBACK</span>
			<span class="float-right">
				<i class="fas fa-angle-right"></i>
			</span>
		</a>
	</div>
</div>
@endsection

@section('dashboard-content')
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		Detail Event
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<form method="POST" action="{{ route('admin.events.update', $event->event_id) }}" enctype="multipart/form-data">
				<input type="hidden" name="_method" value="PUT" />
				{{ csrf_field() }}
				<div class="form-group row">
					<label for="title" class="col-sm-2 col-form-label">Title</label>
					<div class="col-sm-10">
						<input id="title" name="title" class="form-control" type="text" value="{{ $event->title }}" disabled/>
					</div>
				</div>
				<div class="form-group row">
					<label for="category" class="col-sm-2 col-form-label">Category</label>
					<div class="col-sm-10">
						<select id="category" class="form-control" name="category" disabled>
							<option value="1">Human Capital</option>
							<option value="2">Leadership</option>
							<option value="3">Culture</option>
							<option value="4">Psychology</option>
							<option value="5">Education</option>
							<option value="6">Entrepreneur</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="body" class="col-sm-2 col-form-label">Description</label>
					<div class="col-sm-10">
						<textarea id="description" name="description" class="form-control" type="text" placeholder="Description" disabled>{{ $event->description }}</textarea>
					</div>
				</div>
				<div class="form-group row">
					<label for="quota" class="col-sm-2 col-form-label">Quota</label>
					<div class="col-sm-10">
						<input id="quota" name="quota" class="form-control" type="number" value="{{ $event->quota }}" disabled/>
					</div>
				</div>
				<div class="form-group row">
					<label for="location" class="col-sm-2 col-form-label">Location</label>
					<div class="col-sm-10">
						<input id="location" name="location" class="form-control" type="text" value="{{ $event->location }}" disabled/>
					</div>
				</div>
				<!-- <div class="form-group row">
					<label for="img_path" class="col-sm-2 col-form-label">Display Image</label>
					<div class="col-sm-10">
						<input id="img_path" name="img_path[]" class="form-control-file" type="file" multiple="multiple"/>
					</div>
				</div> -->
				<div class="form-group row">
					<label for="start_date" class="col-sm-2 col-form-label">Event Start</label>
					<div class="col-sm-5">
						<input id="start_date" name="start_date" class="form-control" type="date" value="{{ $event->start_date }}" disabled/>
					</div>
					<div class="col-sm-5">
						<input id="start_time" name="start_time" class="form-control" type="time" value="{{ $event->start_time }}" disabled/>
					</div>
				</div>
				<div class="form-group row">
					<label for="end_date" class="col-sm-2 col-form-label">Event End</label>
					<div class="col-sm-5">
						<input id="end_date" name="end_date" class="form-control" type="date" value="{{ $event->end_date }}" disabled/>
					</div>
					<div class="col-sm-5">
						<input id="end_time" name="end_time" class="form-control" type="time" value="{{ $event->end_time }}" disabled/>
					</div>
				</div>
				<!-- <div class="form-group row">
					<label for="media" class="col-sm-2 col-form-label"></label>
					<div class="col-sm-10">
						<button class="btn btn-primary btn-md" type="submit">UPDATE</button>
					</div>
				</div> -->
			</form>
		</div>
	</div>
	<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>

<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		Verified Participants (TODAY)
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th class="align-middle">No</th>
						<th class="align-middle">Registration Code</th>
						<th class="align-middle">Name</th>
						<th class="align-middle">Position</th>
						<th class="align-middle">Company</th>
						<th class="align-middle">Phone</th>
						<th class="align-middle">Status</th>
					</tr>
				</thead>
				<?php $counter = 1; ?>
				<tbody>
					@foreach($verifieds as $verified)
					<tr>
						<td>{{ $counter++ }}</td>
						<td>{{ $verified->registration_code }}</td>
						<td>{{ $verified->name }}</td>
						<td>{{ $verified->position }}</td>
						<td>{{ $verified->company }}</td>
						<td>{{ $verified->phone }}</td>
						<td>Verified</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>

<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		Unverified Participants (TODAY)
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th class="align-middle">No</th>
						<th class="align-middle">Registration Code</th>
						<th class="align-middle">Name</th>
						<th class="align-middle">Position</th>
						<th class="align-middle">Company</th>
						<th class="align-middle">Phone</th>
						<th class="align-middle">Status</th>
					</tr>
				</thead>
				<?php $counter = 1; ?>
				<tbody>
					@foreach($unverifieds as $unverified)
					<tr>
						<td>{{ $counter++ }}</td>
						<td>{{ $unverified->registration_code }}</td>
						<td>{{ $unverified->name }}</td>
						<td>{{ $unverified->position }}</td>
						<td>{{ $unverified->company }}</td>
						<td>{{ $unverified->phone }}</td>
						<td>
							@switch($unverified->status)
							@case(0)
								Unverified
							@break
							@case(1)
								Verified
							@break
							@endswitch
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
@endsection
