@extends('cms-layout')
@section('title', 'Edit Tag: ' . $tag->tag)

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li><a href="{{ route('cms.tags.index') }}">Tags</a></li>	
	<li class="last">Edit Tag: {{ $tag->tag }}</li>
@stop

@section('content')

	<h1 class="section-header">Edit Tag: {{ $tag->tag }}</h1>
	
	<section id="form-con">		
		<form method="POST" action="{{ route('cms.tags.update', $tag->id) }}">
		  	@method('PATCH')
			@csrf
		
			<label for="tag">Tag: </label>
			<input name="tag" type="text" id="tag" value="{{ old('tag') ?? $tag->tag }}">
			@error('tag')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<input name="id" type="hidden" id="id" value="{{ $tag->id }}">			
			<button type="submit">Update</button>			
		</form>
	</section>
@stop