<x-cms.admin-layout>
	<x-slot name="title">Create a New Album</x-slot>

	<x-slot name="pageHeader">Create a New Album</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.homepage') }}">Home</a></li>
		<li><a href="{{ route('cms.basedata.index') }}">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.albums.index') }}">Albums</a></li>
		<li>Create a New Album</li>
	</x-slot>

	<section id="form-con">		
		
		<x-cms.form-validation-errors :errors="$errors" />

		<form method="POST" action="{{ route('cms.basedata.albums.store') }}">
			@csrf

			<label for="title">Title: </label>
			<input name="title" type="text" id="title" value="{{ old('title') }}">

			<label for="genre_id">Genre: </label>	
			<select name="genre_id">				
				@foreach($selectBoxes['genreList'] as $key => $value)		
					<option value="{{$key}}" {{ (old('genre_id') == $key) ? "selected='selected" : "" }}>{{ $value }}</option>
				@endforeach
			</select>
		
			<label for="label_id">Label:</label>	
			<select name="label_id">				
				@foreach($selectBoxes['labelList'] as $key => $value)		
					<option value="{{$key}}" {{ (old('label_id') == $key) ? "selected='selected" : ""}}>{{ $value }}</option>
				@endforeach
			</select>

			<label for="format_id">Format:</label>	
			<select name="format_id">				
				@foreach($selectBoxes['formatList'] as $key => $value)		
					<option value="{{ $key }}" {{ (old('format_id') == $key) ? "selected='selected" : "" }}>{{ $value }}</option>
				@endforeach
			</select>

			<label for="year_released">Year Released: </label>
			<input name="year_released" type="text" id="year_released"  value="{{ old('year_released') }}">

			<label for="purchase_date">Purchase Date: </label>
			<input name="purchase_date" type="text" id="purchase_date" value="{{ old('purchase_date') }}">

			<label for="purchase_price">Purchase Price: </label>
			<input name="purchase_price" type="text" id="purchase_price" value="{{ old('purchase_price') }}">

			<label for="album_thumbnail">Album Thumbnail: </label>
			<input name="album_thumbnail" type="text" id="album_thumbnail" value="{{ old('album_thumbnail') }}">

			<label for="album_image">Album Image: </label>
			<input name="album_image" type="text" id="album_image" value="{{ old('album_image') }}">

			<label for="use_track_artwork">Use track artwork: </label>
			<input name="use_track_artwork" type="checkbox" value="1" id="use_track_artwork" value="{{ old('use_track_artwork') }}">

			<button type="submit">Create Album</button>
		</form>
	</section>
</x-cms.admin-layout>