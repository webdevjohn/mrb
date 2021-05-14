<x-cms.admin-layout>
	<x-slot name="title">Albums - Add a new track to: {{ $album->title }}</x-slot>

	<x-slot name="pageHeader">Add a new track to: {{ $album->title }}</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.homepage') }}">Home</a></li>
		<li><a href="{{ route('cms.basedata.index') }}">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.albums.index') }}">Albums</a></li>
		<li><a href="{{ route('cms.basedata.albums.tracks.index', $album->slug) }}">{{ $album->title }}</a></li>
		<li>Create Track</li>
	</x-slot>
	
	<section id="form-con">		

		<form method="POST" action="{{ route('cms.basedata.albums.tracks.store', $album->slug) }}">
			@csrf

			<label for="artists[]">Artists:</label>	
			{!! Form::select('artists[]', $selectBoxes['artistList'], null, ['id' => 'artists', 'multiple']) !!}
			@error('artists')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="title">Title: </label>
			<input name="title" type="text" id="title">
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
					<option value="{{$key}}" {{ ($album->label_id === $key) ? "selected='selected" : ""}}>{{ $value }}</option>
				@endforeach
			</select>
			@error('label_id')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="tags[]">Tags:</label>	
			{!! Form::select('tags[]', $selectBoxes['tagList'], null, ['id' => 'tags', 'multiple']) !!}
			@error('tags')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<input name="format_id" type="hidden" value="{{ $album->format_id }}">			
			<input name="year_released" type="hidden" value="{{ $album->year_released }}">					
			<input name="purchase_date" type="hidden" value="{{ $album->purchase_date }}">					
			<input name="purchase_price" type="hidden" value="0.00">						
			<input name="album_id" type="hidden" value="{{ $album->id }}">
	
			<button type="submit">Create Track</button>		
		</form>
	</section>

	<x-slot name="javascript">
		<script>
			$('#artists').select2({
				placeholder: "Select Artists"
			});

			$('#tags').select2({
				placeholder: "Select Tags"
			});
		</script>
	</x-slot>
</x-cms.admin-layout>