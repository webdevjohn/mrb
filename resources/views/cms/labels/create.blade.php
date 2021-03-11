@extends('cms-layout')
@section('title', 'Create a New Label')

@section('breadcrums')
	<li><a href="{!! URL::route('cms.homepage') !!}">Home</a></li>
	<li>&gt;  &nbsp;</li>
	<li><a href="{!! URL::route('cms.labels.index') !!}">Labels</a></li>
	<li>&gt;</li>
	<li class="active-breadcrum">Create a New Label</li>
@stop

@section('content')
	
	<h1 class="section-header">Create a New Record Label</h1>

	<section id="form-con">		
	
		<form method="POST" action="{{ route('cms.labels.store') }}">
			{{ csrf_field() }}

			<label for="label">Record Label: </label>
			<input name="label" type="text" id="label" value="{{ old('label') }}">
			{!! $errors->first('label', '<span class="form-input-error">:message</span>') !!}
			
			<button type="submit">Create a new Record Label</button>			
		</form>
	</section>
@stop