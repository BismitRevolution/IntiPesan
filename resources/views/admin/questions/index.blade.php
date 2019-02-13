@extends('admin.pages.question')

@section('more-js')
<!-- <script type="text/javascript" src="{{ asset('js/admin/search.js') }}"></script>
<script type="text/javascript">
	$("#notification-search").keyup(function() {
		search("notification-search", "notification-table", 1);
	});
</script> -->
@endsection

@section('dashboard-content')
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		Session Question
	</div>
	<div class="card-body">

		<!-- <div class="input-group mb-3">
			<input id="session-search" type="text" class="form-control" placeholder="Search keyword">
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="button">
					<i class="fas fa-search"></i>
				</button>
			</div>
		</div> -->

		<div class="table-responsive">
			<table class="table table-bordered" id="session-table" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th class="align-middle">No</th>
						<th class="align-middle">Question</th>
                        <th class="align-middle">Question Type</th>
						<!-- <th class="align-middle">Required</th> -->
						<th class="align-middle">Created At</th>
						<th class="align-middle">Updated At</th>
						<th class="align-middle">Actions</th>
					</tr>
				</thead>
				<?php $counter = 1; ?>
				<tbody>
					@foreach($sessions as $question)
					<tr>
						<td class="text-center">{{ $counter++ }}</td>
						<td class="cell-md">{{ $question->question }}</td>
                        <td>
                            @switch($question->answer_type)
                            @case(1)
                                Short Text
                            @break
                            @case(2)
                                Long Text
                            @break
                            @case(3)
                                Scale
                            @break
                            @endswitch
                        </td>
						<!-- <td>
							@switch($question->required)
							@case(true)
								YES
							@break
							@case(false)
								NO
							@break
							@endswitch
						</td> -->
						<td class="cell-max">{{ $question->created_at }}</td>
						<td class="cell-max">{{ $question->updated_at }}</td>
						<td class="cell-max">
							<form action="{{ route('admin.questions.destroy', ['id' => $question->question_id]) }}" method="POST">
								<input hidden type="hidden" name="_method" value="DELETE" />
								{!! csrf_field() !!}
								<div class="button-group" role="group">
									<a class="btn btn-primary" href="{{ route('admin.questions.edit', ['id' => $question->question_id]) }}">EDIT</a>
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
		Speaker Question
	</div>
	<div class="card-body">

		<!-- <div class="input-group mb-3">
			<input id="speaker-search" type="text" class="form-control" placeholder="Search keyword">
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="button">
					<i class="fas fa-search"></i>
				</button>
			</div>
		</div> -->

		<div class="table-responsive">
			<table class="table table-bordered" id="speaker-table" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th class="align-middle">No</th>
						<th class="align-middle">Question</th>
                        <th class="align-middle">Question Type</th>
						<th class="align-middle">Required</th>
						<th class="align-middle">Created At</th>
						<th class="align-middle">Updated At</th>
						<th class="align-middle">Actions</th>
					</tr>
				</thead>
				<?php $counter = 1; ?>
				<tbody>
					@foreach($speakers as $question)
					<tr>
						<td class="text-center">{{ $counter++ }}</td>
						<td class="cell-md">{{ $question->question }}</td>
                        <td>
                            @switch($question->answer_type)
                            @case(1)
                                Single-line Text
                            @break
                            @case(2)
                                Long Text
                            @break
                            @case(3)
                                Scale
                            @break
                            @endswitch
                        </td>
						<td>
							@switch($question->required)
							@case(true)
								YES
							@break
							@case(false)
								NO
							@break
							@endswitch
						</td>
						<td class="cell-max">{{ $question->created_at }}</td>
						<td class="cell-max">{{ $question->updated_at }}</td>
						<td class="cell-max">
							<form action="{{ route('admin.questions.destroy', ['id' => $question->question_id]) }}" method="POST">
								<input hidden type="hidden" name="_method" value="DELETE" />
								{!! csrf_field() !!}
								<div class="button-group" role="group">
									<a class="btn btn-primary" href="{{ route('admin.questions.edit', ['id' => $question->question_id]) }}">EDIT</a>
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
