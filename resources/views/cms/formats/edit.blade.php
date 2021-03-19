@extends('cms-layout')
@section('title', 'Edit Format')

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li><a href="{{ route('cms.formats.index') }}">Formats</a></li>	
	<li class="last">Edit Format: {{ $format->format }}</li>
@stop

@section('content')
	
	<h1 class="section-header">Edit Format: {{ $format->format }}</h1>

	<section id="form-con">		

		<form method="POST" action="{{ route('cms.formats.update', $format->id) }}">
			@method('PATCH')
			@csrf

			<label for="format">Format: </label>
			<input name="format" type="text" id="format" value="{{ $format->format }}">
			@error('format')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror
		
			<button type="submit">Update Format</button>			
		</form>
	</section>
@stop