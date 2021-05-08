@extends('cms-layout')
@section('title', 'Create a New Label')

@section('page-header')
	<h1>Create a New Record Label</h1>	
@stop

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li><a href="{{ route('cms.basedata.labels.index') }}">Labels</a></li>
	<li>Create a New Label</li>
@stop

@section('content')
	
	<section id="form-con">		
	
		<form method="POST" action="{{ route('cms.basedata.labels.store') }}" enctype="multipart/form-data">
			@csrf

			<label for="label">Record Label: </label>
			<input name="label" type="text" id="label" value="{{ old('label') }}">
			@error('label')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror
			
			<label for="image">Image: </label>
  			<input name="image" type="file">
			@error('image')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<button type="submit">Create a new Record Label</button>			
		</form>
	</section>
@stop