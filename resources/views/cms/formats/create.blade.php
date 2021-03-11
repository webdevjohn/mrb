@extends('cms-layout')
@section('title', 'Create a New Format')

@section('breadcrums')
	<li><a href="{!! URL::route('cms.homepage') !!}">Home</a></li>
	<li>&gt;  &nbsp;</li>
	<li><a href="{!! URL::route('cms.formats.index') !!}">Formats</a></li>
	<li>&gt;</li>
	<li class="active-breadcrum">Create a New Format</li>
@stop

@section('content')
	
	<h1 class="section-header">Create a new Format</h1>

	<section id="form-con">		

		<form method="POST" action="{{ route('cms.formats.store') }}">
			{{ csrf_field() }}

			<label for="format">Format: </label>
			<input name="format" type="text" id="format" value="{{ old('format') }}">
			{!! $errors->first('format', '<span class="form-input-error">:message</span>') !!}
			
			<button type="submit">Create a new Format</button>			
		</form>
	</section>
@stop