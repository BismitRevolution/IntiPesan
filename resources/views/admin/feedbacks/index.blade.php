@extends('admin.pages.feedback')

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/vendor/chartist.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/chartist-custom.css') }}">
@endsection

@section('more-js')
<script type="text/javascript" src="{{ asset('js/vendor/chartist.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/admin/feedback-chart.js') }}"></script>
<!-- <script type="text/javascript" src="{{ asset('js/admin/search.js') }}"></script>
<script type="text/javascript">
	$("#upcoming-search").keyup(function() {
		search("upcoming-search", "upcoming-table", 1);
	});
	$("#past-search").keyup(function() {
		search("past-search", "past-table", 1);
	});
</script> -->
@endsection

@section('dashboard-content')

<script type="text/javascript">
	var tracks = {!! json_encode($tracks->toArray()) !!};
	var q_sessions = {!! json_encode($q_sessions->toArray()) !!};
	var q_speakers = {!! json_encode($q_speakers->toArray()) !!};
</script>

@foreach($tracks as $track)
<div class="card mb-3">
	<div class="card-header">
        <i class="fas fa-table" style="padding-top: 10px;"></i>
        Track {{ $track->number }} - {{ $track->topic }}
		<!-- <form action="{{ route('admin.tracks.destroy', ['id' => $track->track_id]) }}" method="POST">
			<input hidden type="hidden" name="_method" value="DELETE" />
			{!! csrf_field() !!}
			<div>
				<i class="fas fa-table" style="padding-top: 10px;"></i>
				Track {{ $track->number }} - {{ $track->topic }}
				<div style="float: right;">
					<a class="btn btn-primary" href="{{ route('admin.tracks.edit', ['id' => $track->track_id]) }}">EDIT</a>
					<button type="submit" class="btn btn-danger">DELETE</button>
				</div>
			</div>
		</form> -->
	</div>
	<div class="card-body">

		<!-- <div class="input-group mb-3">
			<input id="upcoming-search" type="text" class="form-control" placeholder="Search keyword">
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="button">
					<i class="fas fa-search"></i>
				</button>
			</div>
		</div> -->
        <h5 style="padding-bottom: 10px;">Session's Overview</h5>

		@foreach ($q_sessions as $question)
		<p id="title-t-{{ $track->track_id }}-s-{{ $question->colname }}"></p>
		<div id="t-{{ $track->track_id }}-s-{{ $question->colname }}" class="ct-chart col-12" style="margin-bottom: 35px;"></div>
		@endforeach

		<div class="table-responsive">
			<table class="table table-bordered" id="session-table" width="100%" cellspacing="0">
				<thead>
					<tr>
                        <th class="align-middle">No</th>
                        @foreach ($q_sessions as $question)
                        <th class="align-middle">{{ substr($question->question, 0, 50) }}{{ strlen($question->question) > 50 ? '....' : '' }}</th>
                        @endforeach
						<th class="align-middle">Timestamp</th>
                        <th class="hidden"></th>
					</tr>
				</thead>
				<?php $counter = 1; ?>
				<tbody>
					@foreach($track->feedbacks as $feedback)
					<tr>
						<td class="text-center">{{ $counter++ }}</td>

                        @foreach ($q_sessions as $question)
                        <p class="hidden">{{ $colname = $question->colname }}</p>
                        <td class="cell-md">{{ substr($feedback->$colname, 0, 100) }}{{ strlen($feedback->$colname) > 100 ? '....' : '' }}</td>
                        @endforeach

						<td class="cell-max">{{ $feedback->created_at }}</td>
                        <td class="hidden"></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

        <h5 style="margin-top: 35px; padding-bottom: 10px;">Speaker's Overview</h5>

        @foreach ($track->speakers as $speaker)
        <p style="margin-top: 15px; padding-bottom: 10px; font-weight: bold;">{{ $speaker->name }} - {{ $speaker->position }} at {{ $speaker->company }}</p>

		@foreach ($q_speakers as $question)
		<p id="title-t-{{ $track->track_id }}-sp-{{ $speaker->speaker_id }}-q-{{ $question->colname }}"></p>
		<div id="t-{{ $track->track_id }}-sp-{{ $speaker->speaker_id }}-q-{{ $question->colname }}" class="ct-chart col-12" style="margin-bottom: 35px;"></div>
		@endforeach

        <div class="table-responsive">
			<table class="table table-bordered" id="speaker-table" width="100%" cellspacing="0">
				<thead>
					<tr>
                        <th class="align-middle">No</th>
                        @foreach ($q_speakers as $question)
                        <th class="align-middle">{{ substr($question->question, 0, 50) }}{{ strlen($question->question) > 50 ? '....' : '' }}</th>
                        @endforeach
						<th class="align-middle">Timestamp</th>
                        <th class="hidden"></th>
					</tr>
				</thead>
				<?php $counter = 1; ?>
				<tbody>
					@foreach($speaker->feedbacks as $feedback)
					<tr>
						<td class="text-center">{{ $counter++ }}</td>

                        @foreach ($q_speakers as $question)
                        <p class="hidden">{{ $colname = $question->colname }}</p>
                        <td class="cell-md">{{ substr($feedback->$colname, 0, 100) }}{{ strlen($feedback->$colname) > 100 ? '....' : '' }}</td>
                        @endforeach

						<td class="cell-max">{{ $feedback->created_at }}</td>
                        <td class="hidden"></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
        @endforeach
	</div>
	<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
@endforeach
@endsection
