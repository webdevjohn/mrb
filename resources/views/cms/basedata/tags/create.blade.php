<x-cms.admin-layout>
	<x-slot name="title">Create a New Tag</x-slot>

	<x-slot name="pageHeader">Create a New Tag</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.homepage') }}">Home</a></li>
		<li><a href="{{ route('cms.basedata.index') }}">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.tags.index') }}">Tags</a></li>	
		<li>Create a New Tag</li>
	</x-slot>

	<section id="form-con">		
		<form method="POST" action="{{ route('cms.basedata.tags.store') }}">
			@csrf

			<label for="tag">Tag: </label>
			<input name="tag" type="text" id="tag" value="{{ old('tag') }}">
			@error('tag')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror
			
			<button type="submit">Create a new Tag</button>		
		</form>
	</section>
</x-cms.admin-layout>