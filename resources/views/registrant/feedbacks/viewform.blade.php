@extends('registrant.pages.feedback')

@section('dashboard-content')
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		Feedback Form Track {{ $track->number }} - {{ $track->topic }}
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<form method="POST" action="{{ route('registrant.feedbacks.store') }}" enctype="multipart/form-data">
                <input id="track_id" name="track_id" class="form-control" type="number" value="{{ $track->track_id }}" hidden required/>
				{{ csrf_field() }}
                <h5>Session's Review</h5>

                @foreach ($q_sessions as $question)
                <div class="form-group row">
                    <label for="type" class="col-sm-6 col-form-label">{{ $question->question }}</label>
                    <div class="col-sm-6">
                        @if ($question->answer_type == 1)
                        <input id="{{ $question->colname }}" name="session[{{ $question->colname }}]" class="form-control" type="text" required/>
                        @elseif ($question->answer_type == 2)
                        <textarea id="{{ $question->colname }}" name="session[{{ $question->colname }}]" class="form-control" type="text" required></textarea>
                        @else
                        <select id="{{ $question->colname }}" class="form-control" name="session[{{ $question->colname }}]" type="number">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        @endif
                    </div>
                </div>
                @endforeach

                <h5>Speaker's Review</h5>

                @foreach ($speakers as $speaker)
                <input id="speaker_id" name="speaker[speaker_id][]" class="form-control" type="number" value="{{ $speaker->speaker_id }}" hidden required/>
                <p style="margin-top: 35px;">{{ $speaker->name }} - {{ $speaker->position }} at {{ $speaker->company }}</p>
                    @foreach ($speaker->questions as $question)
                    <div class="form-group row">
                        <label for="type" class="col-sm-6 col-form-label">{{ $question->question }}</label>
                        <div class="col-sm-6">
                            @if ($question->answer_type == 1)
                            <input id="{{ $question->colname }}" name="speaker[{{ $question->colname }}][]" class="form-control" type="text" required/>
                            @elseif ($question->answer_type == 2)
                            <textarea id="{{ $question->colname }}" name="speaker[{{ $question->colname }}][]" class="form-control" type="text" required></textarea>
                            @else
                            <select id="{{ $question->colname }}" class="form-control" name="speaker[{{ $question->colname }}][]" type="number">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @endforeach

				<div class="form-group row">
					<label for="media" class="col-sm-6 col-form-label"></label>
					<div class="col-sm-6">
						<button class="btn btn-primary btn-md" type="submit">SUBMIT</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
