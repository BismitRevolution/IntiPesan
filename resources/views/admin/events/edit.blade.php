@extends('admin.pages.event')

@section('dashboard-content')
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		Edit Event
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<form method="POST" action="{{ route('admin.events.update', $event->event_id) }}" enctype="multipart/form-data">
				<input type="hidden" name="_method" value="PUT" />
				{{ csrf_field() }}
				<div class="form-group row">
					<label for="title" class="col-sm-2 col-form-label">Title</label>
					<div class="col-sm-10">
						<input id="title" name="title" class="form-control" type="text" value="{{ $event->title }}" required/>
					</div>
				</div>
				<div class="form-group row">
					<label for="category" class="col-sm-2 col-form-label">Category</label>
					<div class="col-sm-10">
						<select id="category" class="form-control" name="category">
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
						<textarea id="description" name="description" class="form-control" type="text" placeholder="Description" required>{{ $event->description }}</textarea>
					</div>
				</div>
				<div class="form-group row">
					<label for="quota" class="col-sm-2 col-form-label">Quota</label>
					<div class="col-sm-10">
						<input id="quota" name="quota" class="form-control" type="number" value="{{ $event->quota }}" required/>
					</div>
				</div>
				<div class="form-group row">
					<label for="location" class="col-sm-2 col-form-label">Location</label>
					<div class="col-sm-10">
						<input id="location" name="location" class="form-control" type="text" value="{{ $event->location }}" required/>
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
