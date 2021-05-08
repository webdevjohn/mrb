@extends('cms-layout')
@section('title', 'Edit Track: ' . $track->title)

@section('page-header')
	<h1>Edit Track: {{ $track->title }}</h1>	
@stop

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li><a href="{{ route('cms.basedata.tracks.index') }}">Tracks</a></li>
	<li>{{ $track->title }}</li>
@stop

@section('content')
	
	<section id="form-con">		

		<form method="POST" action="{{ route('cms.basedata.tracks.update', $track->id) }}" enctype="multipart/form-data">
			@method('PATCH')
			@csrf

			<label for="artists[]">Artists:</label>	
			{!! Form::select('artists[]', $selectBoxes['artistList'], $track->getArtistIds(), ['id' => 'artists', 'multiple']) !!}
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
				@foreach($selectBoxes['genreList'] as $key => $value)				
					<option value="{{$key}}" {{ (old('genre_id') ?? $track->genre_id) == $key ? "selected='selected" : ""}}}>{{ $value }}</option>
				@endforeach
			</select>
			@error('genre_id')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="label_id">Label:</label>	
			<select name="label_id">				
				@foreach($selectBoxes['labelList'] as $key => $value)		
					<option value="{{ $key }}" {{ (old('label_id') ?? $track->label_id) == $key ? "selected='selected" : ""}}>{{ $value }}</option>
				@endforeach
			</select>
			@error('label_id')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="format_id">Format:</label>	
			<select name="format_id">				
				@foreach($selectBoxes['formatList'] as $key => $value)		
					<option value="{{ $key }}" {{ (old('format_id') ?? $track->format_id) == $key ? "selected='selected" : ""}}>{{ $value }}</option>
				@endforeach
			</select>
			@error('format_id')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="year_released">Year Released: </label>
			<input name="year_released" type="text" id="year_released" value="{{ old('year_released') ?? $track->year_released }}">
			@error('year_released')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="purchase_date">Purchase Date: </label>
			<input name="purchase_date" type="text" id="purchase_date" value="{{ old('purchase_date') ?? $track->purchase_date }}">
			@error('purchase_date')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="purchase_price">Purchase Price: </label>
			<input name="purchase_price" type="text" id="purchase_price" value="{{ old('purchase_price') ?? $track->purchase_price }}">
			@error('purchase_price')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="tags[]">Tags:</label>	
			{!! Form::select('tags[]', $selectBoxes['tagList'], $track->getTagIds(), ['id' => 'tags', 'multiple']) !!}
			@error('tags')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<hr />

			<label for="image">Image: </label>
  			<input name="image" type="file">
			@error('image')
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

			{{-- <input name="id" type="hidden" value="{{ $track->id }}"> --}}

			<button type="submit">Update Track</button>			
		</form>
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