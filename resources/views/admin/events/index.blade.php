@extends('admin.pages.event')

@section('dashboard-content')
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		List of Events
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th class="align-middle">No</th>
						<th class="align-middle">Title</th>
						<th class="align-middle">Category</th>
						<th class="align-middle">Description</th>
						<th class="align-middle">Participants</th>
						<th class="align-middle">Location</th>
						<!-- <th class="align-middle">Image</th> -->
						<th class="align-middle">Start Date</th>
						<th class="align-middle">Start Time</th>
						<th class="align-middle">End Date</th>
						<th class="align-middle">End Time</th>
						<th class="align-middle">Created At</th>
						<th class="align-middle">Updated At</th>
						<th class="align-middle">Actions</th>
					</tr>
				</thead>
				<?php $counter = 1; ?>
				<tbody>
					@foreach($events as $event)
					<tr>
						<td>{{ $counter++ }}</td>
						<td>
							<a href="{{ route('admin.events.show', ['id' => $event->event_id]) }}">{{ $event->title }}</a>
						</td>
						<td>
							@switch($event->category)
							@case(1)
								Human Capital
							@break
							@case(2)
								Leadership
							@break
							@case(3)
								Culture
							@break
							@case(4)
								Psychology
							@break
							@case(5)
								Education
							@break
							@case(6)
								Entrepreneur
							@break
							@endswitch
						</td>
						<td>{{ substr($event->description, 0, 50) }}{{ strlen($event->description) > 100 ? '....' : '' }}</td>
						<td>{{ $event->registered }}/{{ $event->quota }}</td>
						<td>{{ $event->location }}</td>
						<!-- <td>
							@foreach($event->media as $pic)
							@if($loop->first)
								<img src="{{ '/storage/'.$pic->path }}" alt="" height="200" width="200">
							@endif
							@endforeach
						</td> -->
						<td>{{ $event->start_date }}</td>
						<td>{{ $event->start_time }}</td>
						<td>{{ $event->end_date }}</td>
						<td>{{ $event->end_time }}</td>
						<td>{{ $event->created_at }}</td>
						<td>{{ $event->updated_at }}</td>
						<td>
							<div class="form-inline">
								<form action="{{ route('admin.events.edit', ['id' => $event->event_id]) }}" method="GET">
									<button type="submit" class="btn btn-primary">Edit</button>
								</form>
								<form action="{{ route('admin.events.destroy', ['id' => $event->event_id]) }}" method="POST">
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
