<x-cms.admin-layout>
	<x-slot name="title">Create a New Record Label</x-slot>

	<x-slot name="pageHeader">Create a New Record Label</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.dashboard') }}" title="Dashboard">Dashboard</a></li>
		<li><a href="{{ route('cms.basedata.index') }}" title="Base Data">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.labels.index') }}" title="Labels">Labels</a></li>
		<li>Create a New Label</li>
	</x-slot>
	
	<section id="form-con">		
		
		<x-cms.form-validation-errors :errors="$errors" />	

		<form method="POST" action="{{ route('cms.basedata.labels.store') }}" enctype="multipart/form-data">
			@csrf

			<label for="label">Record Label: </label>
			<input name="label" type="text" id="label" value="{{ old('label') }}">
			
			<label for="image">Image: </label>
  			<input name="image" type="file">
			  
			<button type="submit">Create a new Record Label</button>			
		</form>
	</section>
</x-cms.admin-layout>