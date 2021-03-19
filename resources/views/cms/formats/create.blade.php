@extends('cms-layout')
@section('title', 'Create a New Format')

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li><a href="{{ route('cms.formats.index') }}">Formats</a></li>	
	<li class="last">Create a New Format</li>
@stop

@section('content')
	
	<h1 class="section-header">Create a new Format</h1>

	<section id="form-con">		

		<form method="POST" action="{{ route('cms.formats.store') }}">
			@csrf

			<label for="format">Format: </label>
			<input name="format" type="text" id="format" value="{{ old('format') }}">
			@error('format')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror
			
			<button type="submit">Create a new Format</button>			
		</form>
	</section>
@stop