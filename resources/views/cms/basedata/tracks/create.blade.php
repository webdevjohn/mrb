<x-cms.admin-layout>
	<x-slot name="title">Create a New Track</x-slot>

	<x-slot name="pageHeader">Create a New Track</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.dashboard') }}" title="Dashboard">Dashboard</a></li>
		<li><a href="{{ route('cms.basedata.index') }}" title="Base Data">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.tracks.index') }}" title="Tracks">Tracks</a></li>
		<li>Create a New Track</li>
	</x-slot>
	
	<section id="form-con">		

		<x-cms.form-validation-errors :errors="$errors" />

		<form method="POST" action="{{ route('cms.basedata.tracks.store') }}" enctype="multipart/form-data">
			@csrf
	
			<label for="artists[]">Artists:</label>	
			{!! Form::select('artists[]', $selectBoxes['artistList'], null, ['id' => 'artists', 'multiple']) !!}
	
			<label for="title">Title: </label>
			<input name="title" type="text" id="title" value="{{ old('title') }}">
	
			<label for="genre_id">Genre: </label>	
			<select name="genre_id">				
				@foreach($selectBoxes['genreList'] as $key => $value)				
					<option value="{{$key}}" {{ (old('genre_id') == $key) ? "selected='selected" : ""}}>{{ $value }}</option>
				@endforeach
			</select>

			<label for="label_id">Label:</label>	
			<select name="label_id">				
				@foreach($selectBoxes['labelList'] as $key => $value)		
					<option value="{{ $key }}" {{ (old('label_id') == $key) ? "selected='selected" : ""}}>{{ $value }}</option>
				@endforeach
			</select>

			<label for="format_id">Format:</label>	
			<select name="format_id">				
				@foreach($selectBoxes['formatList'] as $key => $value)		
					<option value="{{ $key }}" {{ (old('format_id') == $key) ? "selected='selected" : ""}}>{{ $value }}</option>
				@endforeach
			</select>

			<label for="year_released">Year Released: </label>
			<input name="year_released" type="text" id="year_released" value="{{ old('year_released') }}">

			<label for="purchase_date">Purchase Date: </label>
			<input name="purchase_date" type="text" id="purchase_date" value="{{ old('purchase_date') }}">

			<label for="purchase_price">Purchase Price: </label>
			<input name="purchase_price" type="text" id="purchase_price" value="{{ old('purchase_price') }}">

			<label for="tags[]">Tags:</label>	
			{!! Form::select('tags[]', $selectBoxes['tagList'], null, ['id' => 'tags', 'multiple']) !!}

			<label for="image">Image: </label>
  			<input name="image" type="file">

			<button type="submit">Create Track</button>				
		</form>
	</section>

	<x-slot name="javascript">
		<script>
			$('#artists').select2({
				placeholder: "Select Artists"
			});

			$('#tags').select2({
				placeholder: "Select Tags"
			});
		</script>
	</x-slot>
</x-cms.admin-layout>