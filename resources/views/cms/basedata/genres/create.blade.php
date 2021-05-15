<x-cms.admin-layout>
	<x-slot name="title">Create a New Genre</x-slot>

	<x-slot name="pageHeader">Create a New Genre</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.dashboard') }}" title="Dashboard">Dashboard</a></li>
		<li><a href="{{ route('cms.basedata.index') }}" title="Base Data">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.genres.index') }}" title="Genres">Genres</a></li>
		<li>Create a New Genre</li>
	</x-slot>
	
	<section id="form-con">		

		<x-cms.form-validation-errors :errors="$errors" />

		<form method="POST" action="{{ route('cms.basedata.genres.store') }}">
			@csrf

			<label for="genre">Genre: </label>
			<input name="genre" type="text" id="genre" value="{{ old('genre') }}">
			
			<button type="submit">Create a new Genre</button>			
		</form>
	</section>
</x-cms.admin-layout>