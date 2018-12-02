@extends('admin.pages.notification')

@section('dashboard-content')
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		List of Notifications
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th class="align-middle">No</th>
						<th class="align-middle">Event</th>
						<th class="align-middle">Type</th>
						<th class="align-middle">Subject</th>
						<th class="align-middle">Content</th>
						<!-- <th class="align-middle">Location</th> -->
						<!-- <th class="align-middle">Image</th> -->
						<th class="align-middle">Publication Date</th>
						<th class="align-middle">Publication Time</th>
						<th class="align-middle">Created At</th>
						<th class="align-middle">Updated At</th>
						<th class="align-middle">Actions</th>
					</tr>
				</thead>
				<?php $counter = 1; ?>
				<tbody>
					@foreach($notifications as $notification)
					<tr>
						<td>{{ $counter++ }}</td>
						<td>{{ $notification->event->title }}</td>
						<td>
							@switch($notification->type)
							@case(-1)
								Registration
							@break
							@case(1)
								H-1
							@break
							@case(2)
								H-2
							@break
							@case(3)
								H-3
							@break
							@case(7)
								H-7
							@break
							@case(0)
								D-DAY
							@break
							@endswitch
						</td>
						<td>{{ $notification->subject }}</td>
						<td>{{ substr($notification->content, 0, 50) }}{{ strlen($notification->content) > 100 ? '....' : '' }}</td>
						<td>{{ $notification->publication_date }}</td>
						<td>{{ $notification->publication_time }}</td>
						<td>{{ $notification->created_at }}</td>
						<td>{{ $notification->updated_at }}</td>
						<td>
							<div class="form-inline">
								<form action="{{ route('admin.notifications.edit', ['id' => $notification->notification_id]) }}" method="GET">
									<button type="submit" class="btn btn-primary">Edit</button>
								</form>
								<form action="{{ route('admin.notifications.destroy', ['id' => $notification->notification_id]) }}" method="POST">
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
