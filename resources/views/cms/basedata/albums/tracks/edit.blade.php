<x-cms.admin-layout>
	<x-slot name="title">Edit Track - {{ $track->title }}</x-slot>

	<x-slot name="pageHeader">Edit Track - {{ $track->title }}</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.dashboard') }}" title="Dashboard">Dashboard</a></li>
		<li><a href="{{ route('cms.basedata.index') }}" title="Base Data">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.albums.index') }}" title="Albums">Albums</a></li>	
		<li><a href="{{ route('cms.basedata.albums.tracks.index', $album->slug) }}" title="{{ $album->title }}">{{ $album->title }}</a></li>	
		<li>{{ $track->title }}</li>
	</x-slot>
	
	<section id="form-con">		
		
		<x-cms.form-validation-errors :errors="$errors" />

		<form method="POST" action="{{ route('cms.basedata.albums.tracks.update', [$album->slug, $track->id]) }}">			
		  	@method('PATCH')
			@csrf

			<label for="artists[]">Artists:</label>	
			{!! Form::select('artists[]', $selectBoxes['artistList'], $track->getArtistIds(), ['id' => 'artists', 'multiple']) !!}

			<label for="title">Title: </label>
			<input name="title" type="text" id="title" value="{{ old('title') ?? $track->title }}">

			<label for="genre_id">Genre: </label>	
			<select name="genre_id">				
				@foreach($selectBoxes['genreList'] as $key => $value)				
					<option value="{{$key}}" {{ (old('genre_id') ?? $track->genre_id) == $key ? "selected='selected" : ""}}>{{ $value }}</option>
				@endforeach
			</select>

			<label for="label_id">Label:</label>	
			<select name="label_id">				
				@foreach($selectBoxes['labelList'] as $key => $value)		
					<option value="{{$key}}" {{ (old('label_id') ?? $album->label_id) == $key ? "selected='selected" : ""}}>{{ $value }}</option>
				@endforeach
			</select>

			<label for="tags[]">Tags:</label>	
			{!! Form::select('tags[]', $selectBoxes['tagList'], $track->getTagIds(), ['id' => 'tags', 'multiple']) !!}

			<hr />

			<label for="mp3_sample_filename">MP3 Filename: </label>
			<input name="mp3_sample_filename" type="text" id="mp3_sample_filename" value="{{ old('mp3_sample_filename') ?? $track->mp3_sample_filename }}">

			<label for="full_track_filename">WAV Filename: </label>
			<input name="full_track_filename" type="text" id="full_track_filename" value="{{ old('full_track_filename') ?? $track->full_track_filename }}">

			<button type="submit">Update Track</button>	
		</form>
	</section>

	<x-slot name="javascript">
		<script>
			$('#artists').select2({
				placeholder: "Select Artists"
			});

			$('#tags').select2({
				placeholder: "Select Tags"
			});
		</script>
	</x-slot>
</x-cms.admin-layout>