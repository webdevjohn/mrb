@extends('cms-layout')
@section('title', 'Edit Format')

@section('breadcrums')
	<li><a href="{!! route('cms.homepage') !!}">Home</a></li>
	<li>&gt;  &nbsp;</li>
	<li><a href="{!! route('cms.formats.index') !!}">Formats</a></li>
	<li>&gt;</li>
	<li class="active-breadcrum">Edit Format: {{ $format->format }}</li>
@stop

@section('content')
	
	<h1 class="section-header">Edit Format: {{ $format->format }}</h1>

	<section id="form-con">		

		<form method="POST" action="{{ route('cms.formats.update', $format->id) }}">
			{{ method_field('PATCH') }}
			{{ csrf_field() }}

			<label for="format">Format: </label>
			<input name="format" type="text" id="format" value="{{ $format->format }}">
			{!! $errors->first('format', '<span class="form-input-error">:message</span>') !!}

			<input name="id" type="hidden" id="id" value="{{ $format->id }}">
		
			<button type="submit">Update Format</button>			
		</form>
	</section>
@stop