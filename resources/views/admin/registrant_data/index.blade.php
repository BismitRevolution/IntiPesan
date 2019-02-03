@extends('admin.pages.registrant')

@section('more-js')
<script type="text/javascript" src="{{ asset('js/admin/search.js') }}"></script>
<script type="text/javascript">
	$("#registrant-search").keyup(function() {
		search("registrant-search", "registrant-table", 1);
	});
</script>
@endsection

@section('dashboard-content')
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		List of Registrants
	</div>
	<div class="card-body">

		<div class="input-group mb-3">
			<input id="registrant-search" type="text" class="form-control" placeholder="Search keyword">
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="button">
					<i class="fas fa-search"></i>
				</button>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-bordered" id="registrant-table" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th class="align-middle">No</th>
						<th class="align-middle">Name</th>
						<th class="align-middle">Email</th>
						<th class="align-middle">Phone</th>
						<th class="align-middle">Company</th>
						<th class="align-middle">Position</th>
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
						<td class="text-center">{{ $counter++ }}</td>
						<td class="cell-md">{{ $registrant->name }}</td>
						<td class="cell-max">{{ $registrant->email }}</td>
						<td class="cell-max">{{ $registrant->phone }}</td>
						<td class="cell-max">{{ $registrant->company }}</td>
						<td class="cell-max">{{ $registrant->position }}</td>
						<td class="cell-max">{{ substr($registrant->company_address, 0, 50) }}{{ strlen($registrant->company_address) > 100 ? '....' : '' }}</td>
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
						<td class="cell-max">{{ $registrant->event->title }}</td>
						<td class="cell-max">{{ $registrant->created_at }}</td>
						<td class="cell-max">{{ $registrant->updated_at }}</td>
						<td class="cell-max">
							<form class="" action="{{ route('admin.registrants.destroy', ['id' => $registrant->registrant_id]) }}" method="POST">
								<input hidden type="hidden" name="_method" value="DELETE" />
								{!! csrf_field() !!}
								<div class="button-group" role="group">
									<a href="{{ route('admin.registrants.edit', ['id' => $registrant->registrant_id]) }}" class="btn btn-primary">EDIT</a>
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
@endsection
