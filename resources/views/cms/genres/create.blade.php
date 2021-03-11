@extends('cms-layout')
@section('title', 'Create a New Genre')

@section('breadcrums')
	<li><a href="{!! URL::route('cms.homepage') !!}">Home</a></li>
	<li>&gt;  &nbsp;</li>
	<li><a href="{!! URL::route('cms.genres.index') !!}">Genres</a></li>
	<li>&gt;</li>
	<li class="active-breadcrum">Create a New Genre</li>
@stop

@section('content')
	
	<h1 class="section-header">Create a New Genre</h1>

	<section id="form-con">		

		<form method="POST" action="{{ route('cms.genres.store') }}">
			{{ csrf_field() }}

			<label for="genre">Genre: </label>
			<input name="genre" type="text" id="genre" value="{{ old('genre') }}">
			{!! $errors->first('genre', '<span class="form-input-error">:message</span>') !!}
			
			<button type="submit">Create a new Genre</button>			
		</form>

	</section>
@stop