@extends('cms-layout')
@section('title', 'Edit Genre')

@section('page-header')
	<h1>Edit Genre: {{ $genre->genre }}</h1>	
@stop

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li><a href="{{ route('cms.basedata.genres.index') }}">Genres</a></li>
	<li>Edit Genre: {{ $genre->genre }}</li>
@stop

@section('content')
	
	<h1 class="section-header">Edit Genre: {{ $genre->genre }}</h1>

	<section id="form-con">		
		<form method="POST" action="{{ route('cms.basedata.genres.update', $genre->slug) }}">
			@method('PATCH')
			@csrf

			<label for="genre">Genre: </label>
			<input name="genre" type="text" id="genre" value="{{ old('genre') ?? $genre->genre }}">
			@error('genre')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<button type="submit">Update Genre</button>			
		</form>
	</section>
@stop