@extends('cms-layout')
@section('title', 'Create a New Tag')

@section('breadcrums')
	<li><a href="{!! URL::route('cms.homepage') !!}">Home</a></li>
	<li>&gt;  &nbsp;</li>
	<li><a href="{!! URL::route('cms.tags.index') !!}">Tags</a></li>
	<li>&gt;</li>
	<li class="active-breadcrum">Create a New Tag</li>
@stop

@section('content')
	
	<h1 class="section-header">Create a New Tag</h1>

	<section id="form-con">		
		<form method="POST" action="{{ route('cms.tags.store') }}">
			{{ csrf_field() }}

			<label for="tag">Tag: </label>
			<input name="tag" type="text" id="tag" value="{{ old('tag') }}">
			{!! $errors->first('tag', '<span class="form-input-error">:message</span>') !!}
			
			<button type="submit">Create a new Tag</button>		
		</form>
	</section>
@stop