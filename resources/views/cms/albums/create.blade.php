@extends('cms-layout')
@section('title', 'Create a New Album')

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li><a href="{{ route('cms.albums.index') }}">Albums</a></li>
	<li class="last">Create a New Album</li>
@stop

@section('content')
	
	<h1 class="section-header">Create a New Album</h1>

	<section id="form-con">		

		<form method="POST" action="{{ route('cms.albums.store') }}">
			@csrf

			<label for="title">Title: </label>
			<input name="title" type="text" id="title" value="{{ old('title') }}">
			@error('title')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="genre_id">Genre: </label>	
			<select name="genre_id">				
				@foreach($genreList as $key => $value)		
					<option value="{{$key}}" {{ (old('genre_id') == $key) ? "selected='selected" : "" }}>{{ $value }}</option>
				@endforeach
			</select>
			@error('genre_id')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror
		
			<label for="label_id">Label:</label>	
			<select name="label_id">				
				@foreach($labelList as $key => $value)		
					<option value="{{$key}}" {{ (old('label_id') == $key) ? "selected='selected" : "" }}>{{ $value }}</option>
				@endforeach
			</select>
			@error('label_id')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="format_id">Format:</label>	
			<select name="format_id">				
				@foreach($formatList as $key => $value)		
					<option value="{{ $key }}" {{ (old('format_id') == $key) ? "selected='selected" : "" }}>{{ $value }}</option>
				@endforeach
			</select>
			@error('format_id')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="year_released">Year Released: </label>
			<input name="year_released" type="text" id="year_released"  value="{{ old('year_released') }}">
			@error('year_released')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="purchase_date">Purchase Date: </label>
			<input name="purchase_date" type="text" id="purchase_date" value="{{ old('purchase_date') }}">
			@error('purchase_date')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="purchase_price">Purchase Price: </label>
			<input name="purchase_price" type="text" id="purchase_price" value="{{ old('purchase_price') }}">
			@error('purchase_price')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="album_thumbnail">Album Thumbnail: </label>
			<input name="album_thumbnail" type="text" id="album_thumbnail" value="{{ old('album_thumbnail') }}">
			@error('album_thumbnail')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="album_image">Album Image: </label>
			<input name="album_image" type="text" id="album_image" value="{{ old('album_image') }}">
			@error('album_image')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="use_track_artwork">Use track artwork: </label>
			<input name="use_track_artwork" type="checkbox" value="1" id="use_track_artwork" value="{{ old('use_track_artwork') }}">
			@error('use_track_artwork')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<button type="submit">Create Album</button>
		</form>
	</section>
@stop