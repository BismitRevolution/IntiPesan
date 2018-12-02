@extends('admin.pages.notification')

@section('dashboard-content')
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		Create New Notification
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<form method="POST" action="{{ route('admin.notifications.store') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group row">
					<label for="event_id" class="col-sm-2 col-form-label">Event</label>
					<div class="col-sm-10">
						<select id="event_id" class="form-control" name="event_id">
							@foreach($events as $event)
							<option value="{{ $event->event_id }}">{{ $event->title }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="type" class="col-sm-2 col-form-label">Type</label>
					<div class="col-sm-10">
						<select id="type" class="form-control" name="type">
							<option value="-1">Registration</option>
							<option value="1">H-1</option>
							<option value="2">H-2</option>
							<option value="3">H-3</option>
							<option value="7">H-7</option>
							<option value="0">D-DAY</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="content" class="col-sm-2 col-form-label">Content</label>
					<div class="col-sm-10">
						<textarea id="content" name="content" class="form-control" type="text" placeholder="Description" required></textarea>
					</div>
				</div>
				<!-- <div class="form-group row">
					<label for="location" class="col-sm-2 col-form-label">Location</label>
					<div class="col-sm-10">
						<input id="location" name="location" class="form-control" type="text" placeholder="Location" required/>
					</div>
				</div> -->
				<!-- <div class="form-group row">
					<label for="start_date" class="col-sm-2 col-form-label">Publication</label>
					<div class="col-sm-5">
						<input id="publication_date" name="publication_date" class="form-control" type="date" value="2018-11-27" hidden required/>
					</div>
					<div class="col-sm-5">
						<input id="publication_time" name="publication_time" class="form-control" type="time" value="09:00:00" hidden required/>
					</div>
				</div> -->
				<div class="form-group row">
					<label for="media" class="col-sm-2 col-form-label"></label>
					<div class="col-sm-10">
						<button class="btn btn-primary btn-md" type="submit">CREATE</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
@endsection
