@extends('admin.pages.article')

@section('dashboard-content')
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		Create New Article
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<form method="POST" action="{{ route('admin.articles.update', $article->article_id) }}" enctype="multipart/form-data">
				<input type="hidden" name="_method" value="PUT" />
				{{ csrf_field() }}
				<div class="form-group row">
					<label for="title" class="col-sm-2 col-form-label">Title</label>
					<div class="col-sm-10">
						<input id="title" name="title" for="title" class="form-control" type="text" value="{{ $article->title }}"  required/>
					</div>
				</div>
				<div class="form-group row">
					<label for="body" class="col-sm-2 col-form-label">Content</label>
					<div class="col-sm-10">
						<textarea id="body" name="body" for="body" class="form-control" type="text" required>{{ $article->body }}</textarea>
					</div>
				</div>
				<!-- <div class="form-group row">
					<label for="media" class="col-sm-2 col-form-label">Attachment</label>
					<div class="col-sm-10">
						<input id="media" name="media[]" class="form-control-file" type="file" multiple="multiple"/>
					</div>
				</div> -->
				<div class="form-group row">
					<label for="media" class="col-sm-2 col-form-label"></label>
					<div class="col-sm-10">
						<button class="btn btn-primary btn-md" type="submit">UPDATE</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
@endsection
