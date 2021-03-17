@extends('cms-layout')
@section('title', 'Edit Label')

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li><a href="{{ route('cms.labels.index') }}">Labels</a></li>
	<li class="last">Edit Label: {{ $label->label }}</li>
@stop

@section('content')
	
	<h1 class="section-header">Edit Label: {{ $label->label }}</h1>

	<section id="form-con">		

		<form method="POST" action="{{ route('cms.labels.update', $label->slug) }}">
			@method('PATCH')
			@csrf

			<label for="label">Record Label: </label>
			<input name="label" type="text" id="label" value="{{ old('label') ?? $label->label }}">
			@error('label')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="label_thumbnail">Thumbnail: </label>
			<input name="label_thumbnail" type="text" id="label" value="{{ old('label_thumbnail') ?? $label->label_thumbnail }}">
			@error('label_thumbnail')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="label_image">Main Image: </label>
			<input name="label_image" type="text" id="label" value="{{ old('label_image') ?? $label->label_image }}">
			@error('label_image')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror
			
			<button type="submit">Update</button>	
		
		</form>
	</section>
@stop