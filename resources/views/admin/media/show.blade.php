<h1>title : {{ $event->title }}</h1>
<p>id : {{ $event->event_id }}</p>

@if(!$media->isEmpty())
	@foreach($media as $item)
    <a href="{{ '/storage/'.$item->path }}">{{ $item->section."-".$item->filename }}</a>
		<form class="" action="{{ route('admin.media.destroy', $item->media_id) }}" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}
			<input hidden type="hidden" name="_method" value="DELETE" />
  		<input type="submit" name="" value="delete file">
		</form>
    <br>
  @endforeach
@else
  No Media
@endif

<h3>
  Upload new media
</h3>

<form class="" action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
	{{ csrf_field() }}

  <input type="hidden" name="event_id" value="{{ $event->event_id }}">
  <br>
  <label for="section">section</label>
  <input type="text" name="section" value="">
  <br>
  <label for="filename">filename</label>
  <input type="text" name="filename" value="">
  <br>

  <label for="file">input file</label>
	<input id="media" name="media[]" class="form-control-file" type="file" multiple="multiple"/>

  <br>

  <input type="submit" name="" value="submit">
</form>
