@extends('cms-layout')
@section('title', 'Create a New Format')

@section('page-header')
	<h1>Create a new Format</h1>	
@stop

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li><a href="{{ route('cms.basedata.formats.index') }}">Formats</a></li>	
	<li>Create a New Format</li>
@stop

@section('content')
	
	<section id="form-con">		

		<form method="POST" action="{{ route('cms.basedata.formats.store') }}">
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