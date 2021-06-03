<x-cms.admin-layout>
	<x-slot name="title">Edit Playlist: {{ $playlist->name }}</x-slot>

	<x-slot name="pageHeader">Edit Playlist: {{ $playlist->name }}</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.dashboard') }}" title="Dashboard">Dashboard</a></li>
		<li><a href="{{ route('cms.basedata.index') }}" title="Base Data">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.playlists.index') }}" title="Playlists">Playlists</a></li>
		<li>Edit Playlist</li>
	</x-slot>

	<section id="form-con">		
		
		<x-cms.form-validation-errors :errors="$errors" />		

		<form method="POST" action="{{ route('cms.basedata.playlists.update', $playlist->slug) }}" enctype="multipart/form-data">
            @method('PATCH')
			@csrf

			<label for="name">Name:</label>
			<input name="name" type="text" id="name" value="{{ $playlist->name }}">

			<label for="genre_id">Genre: </label>	
			<select name="genre_id">				
				@foreach($genreList as $key => $value)		
					<option value="{{$key}}" {{ ($playlist->genre_id == $key) ? "selected='selected" : ""}}>{{ $value }}</option>					
				@endforeach
			</select>	

			<label for="image">Image:</label>
  			<input name="image" type="file">

			<button type="submit">Update Playlist</button>
		
		</form>
	</section>
</x-cms.admin-layout>