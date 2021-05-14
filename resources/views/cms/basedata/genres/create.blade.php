<x-cms.admin-layout>
	<x-slot name="title">Create a New Genre</x-slot>

	<x-slot name="pageHeader">Create a New Genre</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.homepage') }}">Home</a></li>
		<li><a href="{{ route('cms.basedata.index') }}">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.genres.index') }}">Genres</a></li>
		<li>Create a New Genre</li>
	</x-slot>
	
	<section id="form-con">		
		<form method="POST" action="{{ route('cms.basedata.genres.store') }}">
			@csrf

			<label for="genre">Genre: </label>
			<input name="genre" type="text" id="genre" value="{{ old('genre') }}">
			@error('genre')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror
			
			<button type="submit">Create a new Genre</button>			
		</form>
	</section>
</x-cms.admin-layout>