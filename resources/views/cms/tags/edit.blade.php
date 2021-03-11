@extends('cms-layout')
@section('title', 'Edit Tag: ' . $tag->tag)

@section('breadcrums')
	<li><a href="{!! URL::route('cms.homepage') !!}">Home</a></li>
	<li>&gt;  &nbsp;</li>
	<li><a href="{!! URL::route('cms.tags.index') !!}">Tags</a></li>
	<li>&gt;</li>
	<li class="active-breadcrum">Edit Tag: {{ $tag->tag }}</li>
@stop

@section('content')

	<h1 class="section-header">Edit Tag: {{ $tag->tag }}</h1>
	
	<section id="form-con">		
		<form method="POST" action="{{ route('cms.tags.update', $tag->id) }}">
			{{ method_field('PATCH') }}
			{{ csrf_field() }}

			<label for="tag">Tag: </label>
			<input name="tag" type="text" id="tag" value="{{ old('tag') ?? $tag->tag }}">
			{!! $errors->first('tag', '<span class="form-input-error">:message</span>') !!}

			<input name="id" type="hidden" id="id" value="{{ $tag->id }}">			
			<button type="submit">Update</button>			
		</form>
	</section>
@stop