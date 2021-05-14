<x-cms.admin-layout>
	<x-slot name="title">Create a new Format</x-slot>

	<x-slot name="pageHeader">Create a new Format</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.homepage') }}">Home</a></li>
		<li><a href="{{ route('cms.basedata.index') }}">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.formats.index') }}">Formats</a></li>	
		<li>Create a New Format</li>
	</x-slot>
	
	<section id="form-con">		
		<form method="POST" action="{{ route('cms.basedata.formats.store') }}">
			@csrf

			<label for="format">Format: </label>
			<input name="format" type="text" id="format" value="{{ old('format') }}">
			@error('format')
    			<div class="form-input-error">{{ $message }}</div>
			@enderror
			
			<button type="submit">Create a new Format</button>			
		</form>
	</section>
</x-cms.admin-layout>