<x-cms.admin-layout>
	<x-slot name="title">Create a New Artist</x-slot>

	<x-slot name="pageHeader">Create a New Artist</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.homepage') }}">Home</a></li>
		<li><a href="{{ route('cms.basedata.index') }}">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.artists.index') }}">Artists</a></li>
		<li>Create a New Artist</li>
	</x-slot>
	
	<section id="form-con">		
		<form method="POST" action="{{ route('cms.basedata.artists.store') }}">
			@csrf

			<label for="artist_name">Artist: </label>
			<input name="artist_name" type="text" id="artist_name" value="{{ old('artist_name') }}">
			@error('artist_name')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror
		
			<button type="submit">Create Artist</button>	
		</form>
	</section>
</x-cms.admin-layout>