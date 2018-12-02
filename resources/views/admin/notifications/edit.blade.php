@extends('admin.pages.notification')

@section('dashboard-content')
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		Edit Notification
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<form method="POST" action="{{ route('admin.notifications.update', $notification->notification_id) }}" enctype="multipart/form-data">
				<input type="hidden" name="_method" value="PUT" />
				{{ csrf_field() }}
				<div class="form-group row">
					<label for="event_id" class="col-sm-2 col-form-label">Event</label>
					<div class="col-sm-10">
						<select id="event_id" class="form-control" name="event_id">
							@foreach($events as $event)
							@if($event->event_id == $notification->event_id)
							<option value="{{ $event->event_id }}" selected>{{ $event->title }}</option>
							@else
							<option value="{{ $event->event_id }}">{{ $event->title }}</option>
							@endif
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
						<textarea id="content" name="content" class="form-control" type="text" required>{{ $notification->content }}</textarea>
					</div>
				</div>
				<!-- <div class="form-group row">
					<label for="start_date" class="col-sm-2 col-form-label">Publication</label>
					<div class="col-sm-5">
						<input id="publication_date" name="publication_date" class="form-control" type="date" value="{{ $notification->publication_date }}" required disabled/>
					</div>
					<div class="col-sm-5">
						<input id="publication_time" name="publication_time" class="form-control" type="time" value="{{ $notification->publication_time }}" required disabled/>
					</div>
				</div> -->
				<div class="form-group row">
					<label for="media" class="col-sm-2 col-form-label"></label>
					<div class="col-sm-10">
						<button class="btn btn-primary btn-md" type="submit">UPDATE</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
@endsection
