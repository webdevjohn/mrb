@extends('cms-layout')
@section('title', 'Create a New playlist')

@section('breadcrums')
	<li><a href="{!! route('cms.homepage') !!}">Home</a></li>
	<li>&gt;  &nbsp;</li>
	<li><a href="{!! route('cms.playlists.index') !!}">Playlists</a></li>
	<li>&gt;</li>
	<li class="active-breadcrum">Create a New Playlist</li>
@stop

@section('content')
	
	<h1 class="section-header">Create a New Playlist</h1>

	<section id="form-con">		
		
		<form method="POST" action="{{ route('cms.playlists.store') }}">
			{{ csrf_field() }}

			<label for="name">Name:</label>
			<input name="name" type="text" id="name">
			{!! $errors->first('name', '<span class="form-input-error">:message</span>') !!}

			<label for="genre_id">Genre: </label>	
			<select name="genre_id">				
				@foreach($genreList as $key => $value)		
					<option value="{{$key}}" {{ $formControl->isSelectBoxSelected(request()->old('genre_id'), $key)}}>{{ $value }}</option>
				@endforeach
			</select>
			{!! $errors->first('genre_id', '<span class="form-input-error">:message</span>') !!}

		    <label for="thumbnail">Thumbnail:</label>
			<input name="thumbnail" type="text" id="thumbnail">
			{!! $errors->first('thumbnail', '<span class="form-input-error">:message</span>') !!}

	        <label for="image">Image:</label>
			<input name="image" type="text" id="image">
			{!! $errors->first('image', '<span class="form-input-error">:message</span>') !!}

			<button type="submit">Create Playlist</button>
		
		</form>
	</section>
@stop