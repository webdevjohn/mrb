@extends('cms-layout')
@section('title', 'Edit Artist')

@section('breadcrums')
	<li><a href="{!! URL::route('cms.homepage') !!}">Home</a></li>
	<li>&gt;  &nbsp;</li>
	<li><a href="{!! URL::route('cms.artists.index') !!}">Artists</a></li>
	<li>&gt;</li>
	<li class="active-breadcrum">Edit Artist: {{ $artist->artist_name }}</li>
@stop

@section('content')
	
	<h1 class="section-header">Edit Artist</h1>

	<section id="form-con">		

		<form method="POST" action="{{ route('cms.artists.update', $artist->id) }}">
			{{ method_field('PATCH') }}
			{{ csrf_field() }}

			<label for="artist_name">Artist: </label>
			<input name="artist_name" type="text" id="artist_name" value="{{ $artist->artist_name}}">
			{!! $errors->first('artist_name', '<span class="form-input-error">:message</span>') !!}

			<input name="id" type="hidden" id="id" value="{ {$artist->id }}">
			
			<button type="submit">Update Artist</button>	

		</form>
	</section>
@stop