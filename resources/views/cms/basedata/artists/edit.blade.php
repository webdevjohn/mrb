<x-cms.admin-layout>
	<x-slot name="title">Edit Artist</x-slot>

	<x-slot name="pageHeader">Edit Artist</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.homepage') }}">Home</a></li>
		<li><a href="{{ route('cms.basedata.index') }}">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.artists.index') }}">Artists</a></li>
		<li>Edit Artist: {{ $artist->artist_name }}</li>
	</x-slot>

	<section id="form-con">		
		
		<x-cms.form-validation-errors :errors="$errors" />

		<form method="POST" action="{{ route('cms.basedata.artists.update', $artist->slug) }}">
			@method('PATCH')
			@csrf

			<label for="artist_name">Artist: </label>
			<input name="artist_name" type="text" id="artist_name" value="{{ $artist->artist_name}}">
			
			<button type="submit">Update Artist</button>	
		</form>
	</section>
</x-cms.admin-layout>