@extends('cms-layout')
@section('title', 'Create a New playlist')

@section('page-header')
	<h1>Create a New Playlist</h1>	
@stop

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li><a href="{{ route('cms.basedata.playlists.index') }}">Playlists</a></li>	
	<li>Create a New Playlist</li>
@stop

@section('content')

	<section id="form-con">		
		
		<form method="POST" action="{{ route('cms.basedata.playlists.store') }}">
			@csrf

			<label for="name">Name:</label>
			<input name="name" type="text" id="name">
			@error('name')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="genre_id">Genre: </label>	
			<select name="genre_id">				
				@foreach($genreList as $key => $value)		
					<option value="{{$key}}" {{ (old('genre_id') == $key) ? "selected='selected" : ""}}>{{ $value }}</option>					
				@endforeach
			</select>
			@error('genre_id')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

		    <label for="thumbnail">Thumbnail:</label>
			<input name="thumbnail" type="text" id="thumbnail">
			@error('thumbnail')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

	        <label for="image">Image:</label>
			<input name="image" type="text" id="image">
			@error('image')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<button type="submit">Create Playlist</button>		
		</form>
	</section>
@stop
