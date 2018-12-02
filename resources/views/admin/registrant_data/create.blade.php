@extends('admin.pages.registrant')

@section('dashboard-content')
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		Create New Registrant
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<form method="POST" action="{{ route('admin.registrants.store') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group row">
					<label for="name" class="col-sm-2 col-form-label">Name</label>
					<div class="col-sm-10">
						<input id="name" name="name" class="form-control" type="text" placeholder="Name" required/>
					</div>
				</div>
				<div class="form-group row">
					<label for="email" class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-10">
						<input id="email" name="email" class="form-control" type="email" placeholder="Email" required/>
					</div>
				</div>
				<div class="form-group row">
					<label for="position" class="col-sm-2 col-form-label">Position</label>
					<div class="col-sm-10">
						<input id="position" name="position" class="form-control" type="text" placeholder="Position" required/>
					</div>
				</div>
				<div class="form-group row">
					<label for="phone" class="col-sm-2 col-form-label">Phone</label>
					<div class="col-sm-10">
						<input id="phone" name="phone" class="form-control" type="text" placeholder="Phone" required/>
					</div>
				</div>
				<div class="form-group row">
					<label for="company" class="col-sm-2 col-form-label">Company Name</label>
					<div class="col-sm-10">
						<input id="company" name="company" class="form-control" type="text" placeholder="Company Name" required/>
					</div>
				</div>
				<div class="form-group row">
					<label for="company_address" class="col-sm-2 col-form-label">Company Address</label>
					<div class="col-sm-10">
						<textarea id="company_address" name="company_address" class="form-control" type="text" placeholder="Company Address" required></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label for="payment_method" class="col-sm-2 col-form-label">Payment Method</label>
					<div class="col-sm-10">
						<select id="payment_method" class="form-control" name="payment_method">
							<option value="1">Transfer</option>
							<!-- <option value="2">Cash</option> -->
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="event_id" class="col-sm-2 col-form-label">Register to Event</label>
					<div class="col-sm-10">
						<select id="event_id" class="form-control" name="event_id">
							@foreach($events as $event)
							<option value="{{ $event->event_id }}">{{ $event->title }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="" class="col-sm-2 col-form-label"></label>
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
