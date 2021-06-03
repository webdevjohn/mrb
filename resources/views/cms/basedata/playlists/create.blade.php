<x-cms.admin-layout>
	<x-slot name="title">Create a New Playlis</x-slot>

	<x-slot name="pageHeader">Create a New Playlist</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.dashboard') }}" title="Dashboard">Dashboard</a></li>
		<li><a href="{{ route('cms.basedata.index') }}" title="Base Data">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.playlists.index') }}" title="Playlists">Playlists</a></li>
		<li>Create a New Playlist</li>
	</x-slot>

	<section id="form-con">

		<x-cms.form-validation-errors :errors="$errors" />

		<form method="POST" action="{{ route('cms.basedata.playlists.store') }}" enctype="multipart/form-data">
			@csrf

			<label for="name">Name:</label>
			<input name="name" type="text" id="name">

			<label for="genre_id">Genre: </label>	
			<select name="genre_id">				
				@foreach($genreList as $key => $value)		
					<option value="{{$key}}" {{ (old('genre_id') == $key) ? "selected='selected" : ""}}>{{ $value }}</option>					
				@endforeach
			</select>

			<label for="image">Image:</label>
  			<input name="image" type="file">

			<button type="submit">Create Playlist</button>		
		</form>
	</section>
</x-cms.admin-layout>
