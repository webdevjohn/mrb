<x-cms.admin-layout>
	<x-slot name="title">Create a New Record Label</x-slot>

	<x-slot name="pageHeader">Create a New Record Label

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.homepage') }}">Home</a></li>
		<li><a href="{{ route('cms.basedata.index') }}">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.labels.index') }}">Labels</a></li>
		<li>Create a New Label</li>
	</x-slot>
	
	<section id="form-con">			
		<form method="POST" action="{{ route('cms.basedata.labels.store') }}" enctype="multipart/form-data">
			@csrf

			<label for="label">Record Label: </label>
			<input name="label" type="text" id="label" value="{{ old('label') }}">
			@error('label')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror
			
			<label for="image">Image: </label>
  			<input name="image" type="file">
			@error('image')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror

			<button type="submit">Create a new Record Label</button>			
		</form>
	</section>
</x-cms.admin-layout>