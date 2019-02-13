@extends('registrant.pages.feedback')

@section('more-js')
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
<div class="row">
    @foreach($tracks as $track)
    <div class="col-12 col-lg-6">
        <div class="card mb-3">
            <div class="card-header">
        		<form action="#" method="POST">
        			<input hidden type="hidden" name="_method" value="DELETE" />
        			{!! csrf_field() !!}
        			<div>
        				<i class="fas fa-table" style="padding-top: 10px; padding-bottom: 10px;"></i>
        				Track {{ $track->number }} - {{ $track->topic }}
        				<div style="float: right;">
                            @if ($track->reviewed == 0)
                            <a class="btn btn-primary" href="{{ route('registrant.feedbacks.viewform', ['id' => $track->track_id]) }}">GIVE FEEDBACK</a>
                            @else
                            <button type="submit" class="btn btn-success" disabled>FEEDBACK SENT</button>
                            @endif
        				</div>
        			</div>
        		</form>
        	</div>
        	<div class="card-body">
        		<div class="table-responsive">
        			<table class="table table-bordered" id="speaker-table" width="100%" cellspacing="0">
        				<thead>
        					<tr>
        						<th class="align-middle">No</th>
        						<th class="align-middle">Name</th>
        						<th class="align-middle">Position</th>
        						<th class="align-middle">Company</th>
        					</tr>
        				</thead>
        				<?php $counter = 1; ?>
        				<tbody>
        					@foreach($track->speakers as $speaker)
        					<tr>
        						<td class="text-center">{{ $counter++ }}</td>
        						<td class="cell-md">{{ $speaker->name }}</td>
        						<td class="cell-md">{{ substr($speaker->position, 0, 50) }}{{ strlen($speaker->position) > 100 ? '....' : '' }}</td>
        						<td class="cell-max">{{ $speaker->company }}</td>
        					</tr>
        					@endforeach
        				</tbody>
        			</table>
        		</div>
        	</div>
        	<!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>
    </div>
    @endforeach
</div>
@endsection
