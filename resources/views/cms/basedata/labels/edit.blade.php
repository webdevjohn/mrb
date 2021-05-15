<x-cms.admin-layout>
	<x-slot name="title">Edit Label: {{ $label->label }}</x-slot>

	<x-slot name="pageHeader">Edit Label: {{ $label->label }}</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.dashboard') }}" title="Dashboard">Dashboard</a></li>
		<li><a href="{{ route('cms.basedata.index') }}" title="Base Data">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.labels.index') }}" title="Labels">Labels</a></li>
		<li>Edit Label: {{ $label->label }}</li>
	</x-slot>
	
	<section id="form-con">	

		<x-cms.form-validation-errors :errors="$errors" />	

		<form method="POST" action="{{ route('cms.basedata.labels.update', $label->slug) }}" enctype="multipart/form-data">
			@method('PATCH')
			@csrf

			<label for="label">Record Label: </label>
			<input name="label" type="text" id="label" value="{{ old('label') ?? $label->label }}">

			<label for="image">Image: </label>
  			<input name="image" type="file">
			
			<button type="submit">Update</button>			
		</form>
	</section>
</x-cms.admin-layout>