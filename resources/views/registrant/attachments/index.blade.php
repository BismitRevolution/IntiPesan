@extends('registrant.pages.attachment')

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
                Track {{ $track->number }} - {{ $track->topic }}
        	</div>
        	<div class="card-body">
        		<div class="table-responsive">
        			<table class="table table-bordered" id="speaker-table" width="100%" cellspacing="0">
        				<thead>
        					<tr>
        						<th class="align-middle">No</th>
        						<th class="align-middle">Name</th>
        						<th class="align-middle">Attachments</th>
        					</tr>
        				</thead>
        				<?php $counter = 1; ?>
        				<tbody>
        					@foreach($track->speakers as $speaker)
        					<tr>
        						<td class="text-center">{{ $counter++ }}</td>
        						<td class="cell-md">{{ $speaker->name }}</td>
        						<td class="cell-md">
                                    @foreach($speaker->attachments as $attachment)
        							<!-- <form action="{{ route('admin.speakers.removeattachment', ['id' => $attachment->attachment_id, 'event_id' => $track->event_id]) }}" method="POST"> -->
        								<!-- <input hidden type="hidden" name="_method" value="DELETE" /> -->
        								<!-- {!! csrf_field() !!} -->
        								<!-- <div class="button-group" role="group"> -->
        									<a href="{{ '/storage/'.$attachment->path }}" target="_blank">{{ $attachment->filename }}.{{ $attachment->format }}</a>
        									<!-- <button type="submit" class="btn btn-danger">DELETE</button> -->
        								<!-- </div> -->
        							<!-- </form> -->
        							@endforeach
                                </td>
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
