<x-cms.admin-layout>
	<x-slot name="title">Create a New Tag</x-slot>

	<x-slot name="pageHeader">Create a New Tag</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.dashboard') }}" title="Dashboard">Dashboard</a></li>
		<li><a href="{{ route('cms.basedata.index') }}" title="Base Data">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.tags.index') }}" title="tags">Tags</a></li>	
		<li>Create a New Tag</li>
	</x-slot>

	<section id="form-con">		
		
		<x-cms.form-validation-errors :errors="$errors" />

		<form method="POST" action="{{ route('cms.basedata.tags.store') }}">
			@csrf

			<label for="tag">Tag: </label>
			<input name="tag" type="text" id="tag" value="{{ old('tag') }}">
			
			<button type="submit">Create a new Tag</button>		
		</form>
	</section>
</x-cms.admin-layout>