@extends('admin.pages.event')

@section('more-js')
<script type="text/javascript" src="{{ asset('js/admin/search.js') }}"></script>
<script type="text/javascript">
	$("#upcoming-search").keyup(function() {
		search("upcoming-search", "upcoming-table", 1);
	});
	$("#past-search").keyup(function() {
		search("past-search", "past-table", 1);
	});
</script>
@endsection

@section('dashboard-content')
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		Upcoming Events
	</div>
	<div class="card-body">

		<div class="input-group mb-3">
			<input id="upcoming-search" type="text" class="form-control" placeholder="Search keyword">
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="button">
					<i class="fas fa-search"></i>
				</button>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-bordered" id="upcoming-table" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th class="align-middle">No</th>
						<th class="align-middle">Title</th>
						<th class="align-middle">Category</th>
						<th class="align-middle">Description</th>
						<th class="align-middle">Participants</th>
						<th class="align-middle">Location</th>
						<!-- <th class="align-middle">Image</th> -->
						<th class="align-middle">Start Time</th>
						<th class="align-middle">End Time</th>
						<th class="align-middle">Created At</th>
						<th class="align-middle">Updated At</th>
						<th class="align-middle">Actions</th>
					</tr>
				</thead>
				<?php $counter = 1; ?>
				<tbody>
					@foreach($upcoming_events as $event)
					<tr>
						<td class="text-center">{{ $counter++ }}</td>
						<td class="cell-md">
							<a href="{{ route('admin.events.show', ['id' => $event->event_id]) }}">{{ $event->title }}</a>
						</td>
						<td class="cell-max">
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
						<td class="cell-md">{{ substr($event->description, 0, 50) }}{{ strlen($event->description) > 100 ? '....' : '' }}</td>
						<td class="cell-max">{{ $event->registered }}/{{ $event->quota }}</td>
						<td class="cell-md">{{ $event->location }}</td>
						<!-- <td>
							@foreach($event->media as $pic)
							@if($loop->first)
								<img src="{{ '/storage/'.$pic->path }}" alt="" height="200" width="200">
							@endif
							@endforeach
						</td> -->
						<td class="cell-max">{{ $event->start_date ." ". $event->start_time }}</td>
						<td class="cell-max">{{ $event->end_date ." ". $event->end_time }}</td>
						<td class="cell-max">{{ $event->created_at }}</td>
						<td class="cell-max">{{ $event->updated_at }}</td>
						<td class="cell-max">
							<form action="{{ route('admin.events.destroy', ['id' => $event->event_id]) }}" method="POST">
								<input hidden type="hidden" name="_method" value="DELETE" />
								{!! csrf_field() !!}
								<div class="button-group" role="group">
									<a class="btn btn-primary" href="{{ route('admin.events.edit', ['id' => $event->event_id]) }}">EDIT</a>
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

<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		Past Events
	</div>
	<div class="card-body">

		<div class="input-group mb-3">
			<input id="past-search" type="text" class="form-control" placeholder="Search keyword">
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="button">
					<i class="fas fa-search"></i>
				</button>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-bordered" id="past-table" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th class="align-middle">No</th>
						<th class="align-middle">Title</th>
						<th class="align-middle">Category</th>
						<th class="align-middle">Description</th>
						<th class="align-middle">Participants</th>
						<th class="align-middle">Location</th>
						<!-- <th class="align-middle">Image</th> -->
						<th class="align-middle">Start Time</th>
						<th class="align-middle">End Time</th>
						<th class="align-middle">Created At</th>
						<th class="align-middle">Updated At</th>
						<th class="align-middle">Actions</th>
					</tr>
				</thead>
				<?php $counter = 1; ?>
				<tbody>
					@foreach($history_events as $event)
					<tr>
						<td class="text-center">{{ $counter++ }}</td>
						<td class="cell-md">
							<a href="{{ route('admin.events.show', ['id' => $event->event_id]) }}">{{ $event->title }}</a>
						</td>
						<td class="cell-max">
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
						<td class="cell-md">{{ substr($event->description, 0, 50) }}{{ strlen($event->description) > 100 ? '....' : '' }}</td>
						<td class="cell-max">{{ $event->registered }}/{{ $event->quota }}</td>
						<td class="cell-max">{{ $event->location }}</td>
						<!-- <td>
							@foreach($event->media as $pic)
							@if($loop->first)
								<img src="{{ '/storage/'.$pic->path }}" alt="" height="200" width="200">
							@endif
							@endforeach
						</td> -->
						<td class="cell-max">{{ $event->start_date ." ". $event->start_time }}</td>
						<td class="cell-max">{{ $event->end_date ." ". $event->end_time }}</td>
						<td class="cell-max">{{ $event->created_at }}</td>
						<td class="cell-max">{{ $event->updated_at }}</td>
						<td class="cell-max">
							<form action="{{ route('admin.events.destroy', ['id' => $event->event_id]) }}" method="POST">
								<input hidden type="hidden" name="_method" value="DELETE" />
								{!! csrf_field() !!}
								<div class="button-group" role="group">
									<a class="btn btn-primary" href="{{ route('admin.events.edit', ['id' => $event->event_id]) }}">EDIT</a>
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
