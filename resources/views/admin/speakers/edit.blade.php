@extends('admin.pages.track')

@section('dashboard-content')
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		Edit Speaker
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<form method="POST" action="{{ route('admin.speakers.save', ['id' => $speaker->speaker_id, 'event_id' => $event_id]) }}" enctype="multipart/form-data">
				<input type="hidden" name="_method" value="PUT" />
				{{ csrf_field() }}
                <input id="track_id" name="track_id" class="form-control" type="number" value="{{ $speaker->track_id }}" hidden required/>
                <div class="form-group row">
    				<label for="name" class="col-sm-2 col-form-label">Name</label>
    				<div class="col-sm-10">
    					<input id="name" name="name" class="form-control" type="text" placeholder="Name" value="{{ $speaker->name }}" required/>
    				</div>
    			</div>
    			<div class="form-group row">
    				<label for="position" class="col-sm-2 col-form-label">Position</label>
    				<div class="col-sm-10">
    					<input id="position" name="position" class="form-control" type="text" placeholder="Position" value="{{ $speaker->position }}" required/>
    				</div>
    			</div>
    			<div class="form-group row">
    				<label for="company" class="col-sm-2 col-form-label">Company</label>
    				<div class="col-sm-10">
    					<input id="company" name="company" class="form-control" type="text" placeholder="Company" value="{{ $speaker->company }}" required/>
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
