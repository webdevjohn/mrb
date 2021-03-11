@extends('cms-layout')
@section('title', 'Create a New Track')

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li><a href="{{ route('cms.albums.index') }}">Albums</a></li>
	<li><a href="{{ route('cms.albums.tracks.index', $album->slug) }}">{{ $album->title }}</a></li>	
	<li class="last">{{$track->title}}</li>
@stop

@section('content')
	
	<h1 class="section-header">Edit Track</h1>

	<section id="form-con">		

		<form method="POST" action="{{ route('cms.albums.tracks.update', [$album->slug, $track->id]) }}">
			@csrf
		  	@method('PATCH')

			<label for="artists[]">Artists:</label>	
			{!! Form::select('artists[]', $artistList, $track->getArtistIds(), ['id' => 'artists', 'multiple']) !!}
			@error('artists')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="title">Title: </label>
			<input name="title" type="text" id="title" value="{{ old('title') ?? $track->title }}">
			@error('title')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="genre_id">Genre: </label>	
			<select name="genre_id">				
				@foreach($genreList as $key => $value)				
					<option value="{{$key}}" {{ (old('genre_id') ?? $track->genre_id) == $key ? "selected='selected" : ""}}>{{ $value }}</option>
				@endforeach
			</select>
			@error('genre_id')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="label_id">Label:</label>	
			<select name="label_id">				
				@foreach($labelList as $key => $value)		
					<option value="{{$key}}" {{ (old('label_id') ?? $album->label_id) == $key ? "selected='selected" : ""}}>{{ $value }}</option>
				@endforeach
			</select>
			@error('label_id')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="tags[]">Tags:</label>	
			{!! Form::select('tags[]', $tagList, $track->getTagIds(), ['id' => 'tags', 'multiple']) !!}
			@error('tags')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<hr />

			<label for="mp3_sample_filename">MP3 Filename: </label>
			<input name="mp3_sample_filename" type="text" id="mp3_sample_filename" value="{{ old('mp3_sample_filename') ?? $track->mp3_sample_filename }}">
			@error('mp3_sample_filename')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="full_track_filename">WAV Filename: </label>
			<input name="full_track_filename" type="text" id="full_track_filename" value="{{ old('full_track_filename') ?? $track->full_track_filename }}">
			@error('full_track_filename')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<button type="submit">Update Track</button>	
		{!! Form::close() !!}
	</section>
@stop

@section('javascript')
	<script>
		$('#artists').select2({
			 placeholder: "Select Artists"
		});

		$('#tags').select2({
			 placeholder: "Select Tags"
		});
	</script>
@stop