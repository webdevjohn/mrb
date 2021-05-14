<x-cms.admin-layout>
	<x-slot name="title">Edit Format: {{ $format->format }}</x-slot>

	<x-slot name="pageHeader">Edit Format: {{ $format->format }}</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.homepage') }}">Home</a></li>
		<li><a href="{{ route('cms.basedata.index') }}">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.formats.index') }}">Formats</a></li>	
		<li>Edit Format: {{ $format->format }}</li>
	</x-slot>
	
	<section id="form-con">		

		<x-cms.form-validation-errors :errors="$errors" />

		<form method="POST" action="{{ route('cms.basedata.formats.update', $format->id) }}">
			@method('PATCH')
			@csrf

			<label for="format">Format: </label>
			<input name="format" type="text" id="format" value="{{ $format->format }}">
		
			<button type="submit">Update Format</button>			
		</form>
	</section>
</x-cms.admin-layout>