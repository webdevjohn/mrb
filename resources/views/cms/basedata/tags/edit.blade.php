<x-cms.admin-layout>
	<x-slot name="title">Edit Tag: {{ $tag->tag }}</x-slot>

	<x-slot name="pageHeader">Edit Tag: {{ $tag->tag }}</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.homepage') }}">Home</a></li>
		<li><a href="{{ route('cms.basedata.index') }}">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.tags.index') }}">Tags</a></li>	
		<li>Edit Tag: {{ $tag->tag }}</li>
	</x-slot>
	
	<section id="form-con">		
		
		<x-cms.form-validation-errors :errors="$errors" />

		<form method="POST" action="{{ route('cms.basedata.tags.update', $tag->id) }}">
		  	@method('PATCH')
			@csrf
		
			<label for="tag">Tag: </label>
			<input name="tag" type="text" id="tag" value="{{ old('tag') ?? $tag->tag }}">

			<input name="id" type="hidden" id="id" value="{{ $tag->id }}">			
			<button type="submit">Update</button>			
		</form>
	</section>
</x-cms.admin-layout>