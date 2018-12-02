@extends('admin.pages.article')

@section('dashboard-content')
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		Create New Article
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group row">
					<label for="title" class="col-sm-2 col-form-label">Title</label>
					<div class="col-sm-10">
						<input id="title" name="title" class="form-control" type="text" placeholder="Title" required/>
					</div>
				</div>
				<div class="form-group row">
					<label for="category" class="col-sm-2 col-form-label">Category</label>
					<div class="col-sm-10">
						<select id="category" class="form-control" name="category">
							<option value="article">Artikel</option>
							<option value="literatur">Literatur</option>
							<option value="visual">Visual</option>
							<option value="video">Video</option>
							<option value="musik">Musik</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="body" class="col-sm-2 col-form-label">Content</label>
					<div class="col-sm-10">
						<textarea id="body" name="body" class="form-control" type="text" placeholder="Content" required></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label for="media" class="col-sm-2 col-form-label">Attachment</label>
					<div class="col-sm-10">
						<input id="media" name="media[]" class="form-control-file" type="file" multiple="multiple"/>
					</div>
				</div>
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
