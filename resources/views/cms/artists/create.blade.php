@extends('cms-layout')
@section('title', 'Create a New Artist')

@section('breadcrums')
	<li><a href="{!! URL::route('cms.homepage') !!}">Home</a></li>
	<li>&gt;  &nbsp;</li>
	<li><a href="{!! URL::route('cms.artists.index') !!}">Artists</a></li>
	<li>&gt;</li>
	<li class="active-breadcrum">Create a New Artist</li>
@stop

@section('content')
	
	<h1 class="section-header">Create a New Artist</h1>

	<section id="form-con">		

		<form method="POST" action="{{ route('cms.artists.store') }}">
			{{ csrf_field() }}

			<label for="artist_name">Artist: </label>
			<input name="artist_name" type="text" id="artist_name" value="{{ old('artist_name') }}">
			{!! $errors->first('artist_name', '<span class="form-input-error">:message</span>') !!}
		
			<button type="submit">Create Artist</button>	

		</form>
	</section>
@stop