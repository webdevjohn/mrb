@extends('cms-layout')
@section('title', 'Create a New Track')

@section('page-header')
	<h1>Create a New Track</h1>	
@stop

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li><a href="{{ route('cms.tracks.index') }}">Tracks</a></li>	
	<li>Create a New Track</li>
@stop

@section('content')
	
	<section id="form-con">		
		<form method="POST" action="{{ route('cms.tracks.store') }}" enctype="multipart/form-data">
			@csrf
	
			<label for="artists[]">Artists:</label>	
			{!! Form::select('artists[]', $selectBoxes['artistList'], null, ['id' => 'artists', 'multiple']) !!}
			@error('artists')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="title">Title: </label>
			<input name="title" type="text" id="title" value="{{ old('title') }}">
			@error('title')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="genre_id">Genre: </label>	
			<select name="genre_id">				
				@foreach($selectBoxes['genreList'] as $key => $value)				
					<option value="{{$key}}" {{ (old('genre_id') == $key) ? "selected='selected" : ""}}>{{ $value }}</option>
				@endforeach
			</select>
			@error('genre_id')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="label_id">Label:</label>	
			<select name="label_id">				
				@foreach($selectBoxes['labelList'] as $key => $value)		
					<option value="{{ $key }}" {{ (old('label_id') == $key) ? "selected='selected" : ""}}>{{ $value }}</option>
				@endforeach
			</select>
			@error('label_id')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="format_id">Format:</label>	
			<select name="format_id">				
				@foreach($selectBoxes['formatList'] as $key => $value)		
					<option value="{{ $key }}" {{ (old('format_id') == $key) ? "selected='selected" : ""}}>{{ $value }}</option>
				@endforeach
			</select>
			@error('format_id')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="year_released">Year Released: </label>
			<input name="year_released" type="text" id="year_released" value="{{ old('year_released') }}">
			@error('year_released')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="purchase_date">Purchase Date: </label>
			<input name="purchase_date" type="text" id="purchase_date" value="{{ old('purchase_date') }}">
			@error('purchase_date')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="purchase_price">Purchase Price: </label>
			<input name="purchase_price" type="text" id="purchase_price" value="{{ old('purchase_price') }}">
			@error('purchase_price')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="tags[]">Tags:</label>	
			{!! Form::select('tags[]', $selectBoxes['tagList'], null, ['id' => 'tags', 'multiple']) !!}
			@error('tags')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="image">Image: </label>
  			<input name="image" type="file">
			@error('image')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<button type="submit">Create Track</button>				
		</form>
	</section>
@stop

@section('javascript')
	<script>
		$('#artists').select2({
			 placeholder: "Select Artists"
		});

		$('#tags').select2({
			 placeholder: "Select Tags"
		});
	</script>
@stop