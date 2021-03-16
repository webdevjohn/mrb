@extends('cms-layout')
@section('title', 'Create a New Album')

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li><a href="{{ route('cms.albums.index') }}">Albums</a></li>	
	<li class="last">{{ $album->title }}</li>	
@stop

@section('content')
	
	<h1 class="section-header">Edit Album</h1>

	<section id="form-con">		
		<form method="POST" action="{{ route('cms.albums.update', $album->slug) }}">
			@csrf
		  	@method('PATCH')
	
			<label for="title">Title: </label>
			<input name="title" type="text" value="{{ old('title') ?? $album->title }}" id="title">
			@error('title')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror
	
			<label for="genre_id">Genre: </label>	
			<select name="genre_id">				
				@foreach($selectBoxes['genreList'] as $key => $value)		
					<option value="{{$key}}" {{ (old('genre_id') ?? $album->genre_id) == $key ? "selected='selected" : ""}}>{{ $value }}</option>
				@endforeach
			</select>
			@error('genre_id')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="label_id">Label:</label>	
			<select name="label_id">				
				@foreach($selectBoxes['labelList'] as $key => $value)		
					<option value="{{$key}}" {{ (old('label_id') ?? $album->label_id) == $key ? "selected='selected" : ""}}>{{ $value }}</option>
				@endforeach
			</select>
			@error('label_id')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="format_id">Format:</label>	
			<select name="format_id">				
				@foreach($selectBoxes['formatList'] as $key => $value)		
					<option value="{{ $key }}" {{ (old('format_id') ?? $album->format_id) == $key ?  "selected='selected" : ""}}>{{ $value }}</option>
				@endforeach
			</select>
			@error('format_id')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="year_released">Year Released: </label>
			<input name="year_released" type="text" id="year_released" value="{{ old('year_released') ?? $album->year_released }}">
			@error('year_released')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="purchase_date">Purchase Date: </label>
			<input name="purchase_date" type="text" id="purchase_date" value="{{ old('purchase_date') ?? $album->purchase_date }}">
			@error('purchase_date')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="purchase_price">Purchase Price: </label>
			<input name="purchase_price" type="text" id="purchase_price" value="{{ old('purchase_price') ?? $album->purchase_price }}">
			@error('purchase_price')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="album_thumbnail">Album Thumbnail: </label>
			<input name="album_thumbnail" type="text" id="album_thumbnail" value="{{ old('album_thumbnail') ?? $album->album_thumbnail }}">
			@error('album_thumbnail')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="album_image">Album Image: </label>
			<input name="album_image" type="text" id="album_image" value="{{ old('album_image') ?? $album->album_image }}">
			@error('album_image')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="use_track_artwork">Use track artwork: </label>
			<input name="use_track_artwork" type="checkbox" value="{{ old('use_track_artwork') ?? $album->use_track_artwork }}" id="use_track_artwork">
			@error('use_track_artwork')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<button type="submit">Create Album</button>
		
		</form>
	</section>
@stop