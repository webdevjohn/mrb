@extends('cms-layout')
@section('title', 'Edit Genre')

@section('breadcrums')
	<li><a href="{!! URL::route('cms.homepage') !!}">Home</a></li>
	<li>&gt;  &nbsp;</li>
	<li><a href="{!! URL::route('cms.genres.index') !!}">Genres</a></li>
	<li>&gt;</li>
	<li class="active-breadcrum">Edit Genre: {{ $genre->genre }} </li>
@stop

@section('content')
	
	<h1 class="section-header">Edit Genre: {{ $genre->genre }}</h1>

	<section id="form-con">		

		<form method="POST" action="{{ route('cms.genres.update', $genre->id) }}">
			{{ method_field('PATCH') }}
			{{ csrf_field() }}

			<label for="genre">Genre: </label>
			<input name="genre" type="text" id="genre" value="{{ old('genre') ?? $genre->genre }}">
			{!! $errors->first('genre', '<span class="form-input-error">:message</span>') !!}

			<input name="id" type="hidden" id="id" value="{{ $genre->id }}">			
			<button type="submit">Create a new Genre</button>			
		</form>
	</section>
@stop