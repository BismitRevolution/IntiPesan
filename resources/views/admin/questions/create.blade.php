@extends('admin.pages.question')

@section('dashboard-content')
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		Add New Question
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<form method="POST" action="{{ route('admin.questions.store') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
                <div class="form-group row">
                    <label for="type" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <select id="type" class="form-control" name="type" type="number">
                            <option value="1">Session</option>
                            <option value="0">Speaker</option>
                        </select>
                    </div>
                </div>
				<div class="form-group row">
					<label for="question" class="col-sm-2 col-form-label">Question</label>
					<div class="col-sm-10">
						<input id="question" name="question" class="form-control" type="text" placeholder="Question" required/>
					</div>
				</div>
                <div class="form-group row">
                    <label for="answer_type" class="col-sm-2 col-form-label">Question Type</label>
                    <div class="col-sm-10">
                        <select id="answer_type" class="form-control" name="answer_type" type="number">
                            <option value="1">Short Text</option>
                            <option value="2">Long Text</option>
                            <option value="3">Scale</option>
                        </select>
                    </div>
                </div>
				<!-- <div class="form-group row">
					<label for="total" class="col-sm-2 col-form-label">Order</label>
					<div class="col-sm-10"> -->
						<input id="total" name="total" class="form-control" type="number" value="{{ $total }}" hidden required/>
					<!-- </div>
				</div> -->
                <!-- <div class="form-group row">
					<label for="required" class="col-sm-2 col-form-label">Required</label>
					<div class="col-sm-10">
						<select id="required" class="form-control" name="required" type="number">
							<option value="1">Yes</option>
							<option value="0">No</option>
						</select>
					</div>
				</div> -->
				<div class="form-group row">
					<label for="media" class="col-sm-2 col-form-label"></label>
					<div class="col-sm-10">
						<button class="btn btn-primary btn-md" type="submit">CREATE</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
@endsection
