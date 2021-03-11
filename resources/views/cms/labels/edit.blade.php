@extends('cms-layout')
@section('title', 'Edit Label')

@section('breadcrums')
	<li><a href="{!! URL::route('cms.homepage') !!}">Home</a></li>
	<li>&gt;  &nbsp;</li>
	<li><a href="{!! URL::route('cms.labels.index') !!}">Labels</a></li>
	<li>&gt;</li>
	<li class="active-breadcrum">Edit Label: {{ $label->label }}</li>
@stop

@section('content')
	
	<h1 class="section-header">Edit Label: {{ $label->label }}</h1>

	<section id="form-con">		

		<form method="POST" action="{{ route('cms.labels.update', $label->id) }}">
			{{ method_field('PATCH') }}
			{{ csrf_field() }}

			<label for="label">Record Label: </label>
			<input name="label" type="text" id="label" value="{{ old('label') ?? $label->label }}">
			{!! $errors->first('label', '<span class="form-input-error">:message</span>') !!}

			<label for="label_thumbnail">Thumbnail: </label>
			<input name="label_thumbnail" type="text" id="label" value="{{ old('label_thumbnail') ?? $label->label_thumbnail }}">
			{!! $errors->first('label_thumbnail', '<span class="form-input-error">:message</span>') !!}

			<label for="label_image">Main Image: </label>
			<input name="label_image" type="text" id="label" value="{{ old('label_image') ?? $label->label_image }}">
			{!! $errors->first('label_image', '<span class="form-input-error">:message</span>') !!}

			<input name="id" type="hidden" id="id" value="{{ $label->id }}">
			
			<button type="submit">Update</button>	
		
		</form>
	</section>
@stop