@extends('cms-layout')
@section('title', 'Create a New Artist')

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li><a href="{{ route('cms.artists.index') }}">Artists</a></li>
	<li class="last">Create a New Artist</li>
@stop

@section('content')
	
	<h1 class="section-header">Create a New Artist</h1>

	<section id="form-con">		
		<form method="POST" action="{{ route('cms.artists.store') }}">
			@csrf

			<label for="artist_name">Artist: </label>
			<input name="artist_name" type="text" id="artist_name" value="{{ old('artist_name') }}">
			@error('artist_name')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror
		
			<button type="submit">Create Artist</button>	
		</form>
	</section>
@stop
