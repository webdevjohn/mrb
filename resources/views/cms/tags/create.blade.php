@extends('cms-layout')
@section('title', 'Create a New Tag')

@section('page-header')
	<h1>Create a New Tag</h1>	
@stop

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li><a href="{{ route('cms.basedata.tags.index') }}">Tags</a></li>	
	<li>Create a New Tag</li>
@stop

@section('content')
	
	<section id="form-con">		
		<form method="POST" action="{{ route('cms.basedata.tags.store') }}">
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