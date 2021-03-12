@extends('cms-layout')
@section('title', 'Create a New Tag')

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li><a href="{{ route('cms.tags.index') }}">Tags</a></li>	
	<li class="last">Create a New Tag</li>
@stop

@section('content')
	
	<h1 class="section-header">Create a New Tag</h1>

	<section id="form-con">		
		<form method="POST" action="{{ route('cms.tags.store') }}">
			@csrf

			<label for="tag">Tag: </label>
			<input name="tag" type="text" id="tag" value="{{ old('tag') }}">
			@error('tag')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror
			
			<button type="submit">Create a new Tag</button>		
		</form>
	</section>
@stop