@extends('cms-layout')
@section('title', 'Edit Format')

@section('page-header')
	<h1>Edit Format: {{ $format->format }}</h1>	
@stop

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li><a href="{{ route('cms.basedata.formats.index') }}">Formats</a></li>	
	<li>Edit Format: {{ $format->format }}</li>
@stop

@section('content')
	
	<section id="form-con">		

		<form method="POST" action="{{ route('cms.basedata.formats.update', $format->id) }}">
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