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

		<form method="POST" action="{{ route('cms.labels.update', $label->slug) }}" enctype="multipart/form-data">
			@method('PATCH')
			@csrf

			<label for="label">Record Label: </label>
			<input name="label" type="text" id="label" value="{{ old('label') ?? $label->label }}">
			@error('label')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="image">Image: </label>
  			<input name="image" type="file">
			@error('image')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror
			
			<button type="submit">Update</button>			
		</form>
	</section>
@stop