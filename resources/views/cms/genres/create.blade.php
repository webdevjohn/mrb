@extends('cms-layout')
@section('title', 'Create a New Genre')

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li><a href="{{ route('cms.genres.index') }}">Genres</a></li>
	<li class="last">Create a New Genre</li>
@stop

@section('content')
	
	<h1 class="section-header">Create a New Genre</h1>

	<section id="form-con">		
		<form method="POST" action="{{ route('cms.genres.store') }}">
			@csrf

			<label for="genre">Genre: </label>
			<input name="genre" type="text" id="genre" value="{{ old('genre') }}">
			@error('genre')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror
			
			<button type="submit">Create a new Genre</button>			
		</form>
	</section>
@stop