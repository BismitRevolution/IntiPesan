@extends('admin.pages.track')

@section('dashboard-content')
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		Add New Track
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<form method="POST" action="{{ route('admin.tracks.store') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
                <div class="form-group row">
                    <label for="number" class="col-sm-2 col-form-label">Track Number</label>
                    <div class="col-sm-10">
                        <input id="number" name="number" class="form-control" type="number" placeholder="Track Number" required/>
                    </div>
                </div>

				<div class="form-group row">
					<label for="topic" class="col-sm-2 col-form-label">Topic</label>
					<div class="col-sm-10">
						<input id="topic" name="topic" class="form-control" type="text" placeholder="Topic" required/>
					</div>
				</div>
				<!-- <div class="form-group row">
					<label for="event_id" class="col-sm-2 col-form-label">Order</label>
					<div class="col-sm-10"> -->
						<input id="event_id" name="event_id" class="form-control" type="number" value="{{ $event_id }}" hidden required/>
					<!-- </div>
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
