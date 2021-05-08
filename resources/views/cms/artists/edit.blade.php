@extends('cms-layout')
@section('title', 'Edit Artist')

@section('page-header')
	<h1>Edit Artist</h1>	
@stop

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li><a href="{{ route('cms.artists.index') }}">Artists</a></li>
	<li>Edit Artist: {{ $artist->artist_name }}</li>
@stop

@section('content')
	
	<section id="form-con">		
		<form method="POST" action="{{ route('cms.artists.update', $artist->slug) }}">
			@method('PATCH')
			@csrf

			<label for="artist_name">Artist: </label>
			<input name="artist_name" type="text" id="artist_name" value="{{ $artist->artist_name}}">
			@error('artist_name')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror
			
			<button type="submit">Update Artist</button>	
		</form>
	</section>
@stop
