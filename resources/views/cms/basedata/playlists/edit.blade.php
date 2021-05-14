<x-cms.admin-layout>
	<x-slot name="title">Edit Playlist: {{ $playlist->name }}</x-slot>

	<x-slot name="pageHeader">Edit Playlist: {{ $playlist->name }}</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.homepage') }}">Home</a></li>
		<li><a href="{{ route('cms.basedata.index') }}">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.playlists.index') }}">Playlists</a></li>
		<li>Edit Playlist</li>
	</x-slot>

	<section id="form-con">				
		<form method="POST" action="{{ route('cms.basedata.playlists.update', $playlist->slug) }}">
            @method('PATCH')
			@csrf

			<label for="name">Name:</label>
			<input name="name" type="text" id="name" value="{{ $playlist->name }}">
			@error('name')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="genre_id">Genre: </label>	
			<select name="genre_id">				
				@foreach($genreList as $key => $value)		
					<option value="{{$key}}" {{ ($playlist->genre_id == $key) ? "selected='selected" : ""}}>{{ $value }}</option>					
				@endforeach
			</select>
			@error('genre_id')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

		    <label for="thumbnail">Thumbnail:</label>
			<input name="thumbnail" type="text" id="thumbnail" value="{{ $playlist->thumbnail }}">			
			@error('thumbnail')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

	        <label for="image">Image:</label>
			<input name="image" type="text" id="image" value="{{ $playlist->image }}">
			@error('image')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<button type="submit">Update Playlist</button>
		
		</form>
	</section>
</x-cms.admin-layout>