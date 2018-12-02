@extends('admin.pages.registrant')

@section('dashboard-content')
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		List of Registrants
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th class="align-middle">No</th>
						<th class="align-middle">Name</th>
						<th class="align-middle">Email</th>
						<th class="align-middle">Position</th>
						<th class="align-middle">Phone</th>
						<th class="align-middle">Company</th>
						<th class="align-middle">Company Address</th>
						<th class="align-middle">Payment Method</th>
						<th class="align-middle">Status</th>
						<th class="align-middle">Certificate</th>
						<th class="align-middle">Registered to Event</th>
						<th class="align-middle">Created At</th>
						<th class="align-middle">Updated At</th>
						<th class="align-middle">Actions</th>
					</tr>
				</thead>
				<?php $counter = 1; ?>
				<tbody>
					@foreach($registrants as $registrant)
					<tr>
						<td>{{ $counter++ }}</td>
						<td>{{ $registrant->name }}</td>
						<td>{{ $registrant->email }}</td>
						<td>{{ $registrant->position }}</td>
						<td>{{ $registrant->phone }}</td>
						<td>{{ $registrant->company }}</td>
						<td>{{ substr($registrant->company_address, 0, 50) }}{{ strlen($registrant->company_address) > 100 ? '....' : '' }}</td>
						<td>
							@switch($registrant->payment_method)
							@case(1)
								Transfer
							@break
							@case(2)
								Cash
							@break
							@endswitch
						</td>
						<td>
							@switch($registrant->status)
							@case(0)
								Unverified
							@break
							@case(1)
								Verified
							@break
							@endswitch
						</td>
						<td>
							@switch($registrant->certificate)
							@case(0)
								Not taken
							@break
							@case(1)
								Taken
							@break
							@endswitch
						</td>
						<td>{{ $registrant->event->title }}</td>
						<td>{{ $registrant->created_at }}</td>
						<td>{{ $registrant->updated_at }}</td>
						<td>
							<div class="form-inline">
								<form action="{{ route('admin.registrants.edit', ['id' => $registrant->registrant_id]) }}" method="GET">
									<button type="submit" class="btn btn-primary">Edit</button>
								</form>
								<form action="{{ route('admin.registrants.destroy', ['id' => $registrant->registrant_id]) }}" method="POST">
									<input hidden type="hidden" name="_method" value="DELETE" />
									<button type="submit" class="btn btn-danger">Delete</button>
									{!! csrf_field() !!}
								</form>
							</div>
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
