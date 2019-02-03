@extends('admin.pages.notification')

@section('more-js')
<script type="text/javascript" src="{{ asset('js/admin/search.js') }}"></script>
<script type="text/javascript">
	$("#notification-search").keyup(function() {
		search("notification-search", "notification-table", 1);
	});
</script>
@endsection

@section('dashboard-content')
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		List of Notifications
	</div>
	<div class="card-body">

		<div class="input-group mb-3">
			<input id="notification-search" type="text" class="form-control" placeholder="Search keyword">
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="button">
					<i class="fas fa-search"></i>
				</button>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-bordered" id="notification-table" width="100%" cellspacing="0">
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
						<td class="text-center">{{ $counter++ }}</td>
						<td class="cell-md">{{ $notification->event->title }}</td>
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
						<td class="cell-md">{{ $notification->subject }}</td>
						<td class="cell-md">{{ substr($notification->content, 0, 50) }}{{ strlen($notification->content) > 100 ? '....' : '' }}</td>
						<td class="cell-max">{{ $notification->publication_date }}</td>
						<td class="cell-max">{{ $notification->publication_time }}</td>
						<td class="cell-max">{{ $notification->created_at }}</td>
						<td class="cell-max">{{ $notification->updated_at }}</td>
						<td class="cell-max">
							<form action="{{ route('admin.notifications.destroy', ['id' => $notification->notification_id]) }}" method="POST">
								<input hidden type="hidden" name="_method" value="DELETE" />
								{!! csrf_field() !!}
								<div class="button-group" role="group">
									<a class="btn btn-primary" href="{{ route('admin.notifications.edit', ['id' => $notification->notification_id]) }}">EDIT</a>
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
