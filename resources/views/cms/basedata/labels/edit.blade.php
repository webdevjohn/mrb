<x-cms.admin-layout>
	<x-slot name="title">Edit Label: {{ $label->label }}</x-slot>

	<x-slot name="pageHeader">Edit Label: {{ $label->label }}</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.homepage') }}">Home</a></li>
		<li><a href="{{ route('cms.basedata.index') }}">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.labels.index') }}">Labels</a></li>
		<li>Edit Label: {{ $label->label }}</li>
	</x-slot>
	
	<section id="form-con">		
		<form method="POST" action="{{ route('cms.basedata.labels.update', $label->slug) }}" enctype="multipart/form-data">
			@method('PATCH')
			@csrf

			<label for="label">Record Label: </label>
			<input name="label" type="text" id="label" value="{{ old('label') ?? $label->label }}">
			@error('label')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<label for="image">Image: </label>
  			<input name="image" type="file">
			@error('image')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror
			
			<button type="submit">Update</button>			
		</form>
	</section>
</x-cms.admin-layout>