<x-cms.admin-layout>
	<x-slot name="title">Edit Track: {{ $track->title }}</x-slot>

	<x-slot name="pageHeader">Edit Track: {{ $track->title }}</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.dashboard') }}" title="Dashboard">Dashboard</a></li>
		<li><a href="{{ route('cms.basedata.index') }}" title="Base Data">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.tracks.index') }}" title="Tracks">Tracks</a></li>
		<li>{{ $track->title }}</li>
	</x-slot>

	<section id="form-con">	

		<x-cms.form-validation-errors :errors="$errors" />

		<form method="POST" action="{{ route('cms.basedata.tracks.update', $track->id) }}" enctype="multipart/form-data">
			@method('PATCH')
			@csrf

			<label for="artists[]">Artists:</label>	
			{!! Form::select('artists[]', $selectBoxes['artistList'], $track->getArtistIds(), ['id' => 'artists', 'multiple']) !!}
	
			<label for="title">Title: </label>
			<input name="title" type="text" id="title" value="{{ old('title') ?? $track->title }}">
	
			<label for="genre_id">Genre: </label>	
			<select name="genre_id">				
				@foreach($selectBoxes['genreList'] as $key => $value)				
					<option value="{{$key}}" {{ (old('genre_id') ?? $track->genre_id) == $key ? "selected='selected" : ""}}}>{{ $value }}</option>
				@endforeach
			</select>
	
			<label for="label_id">Label:</label>	
			<select name="label_id">				
				@foreach($selectBoxes['labelList'] as $key => $value)		
					<option value="{{ $key }}" {{ (old('label_id') ?? $track->label_id) == $key ? "selected='selected" : ""}}>{{ $value }}</option>
				@endforeach
			</select>
	
			<label for="format_id">Format:</label>	
			<select name="format_id">				
				@foreach($selectBoxes['formatList'] as $key => $value)		
					<option value="{{ $key }}" {{ (old('format_id') ?? $track->format_id) == $key ? "selected='selected" : ""}}>{{ $value }}</option>
				@endforeach
			</select>

			<label for="year_released">Year Released: </label>
			<input name="year_released" type="text" id="year_released" value="{{ old('year_released') ?? $track->year_released }}">
	
			<label for="purchase_date">Purchase Date: </label>
			<input name="purchase_date" type="text" id="purchase_date" value="{{ old('purchase_date') ?? $track->purchase_date }}">

			<label for="purchase_price">Purchase Price: </label>
			<input name="purchase_price" type="text" id="purchase_price" value="{{ old('purchase_price') ?? $track->purchase_price }}">

			<label for="tags[]">Tags:</label>	
			{!! Form::select('tags[]', $selectBoxes['tagList'], $track->getTagIds(), ['id' => 'tags', 'multiple']) !!}

			<hr />

			<label for="image">Image: </label>
  			<input name="image" type="file">
	
			<hr />

			<label for="mp3_sample_filename">MP3 Filename: </label>
			<input name="mp3_sample_filename" type="text" id="mp3_sample_filename" value="{{ old('mp3_sample_filename') ?? $track->mp3_sample_filename }}">
	
			<label for="full_track_filename">WAV Filename: </label>
			<input name="full_track_filename" type="text" id="full_track_filename" value="{{ old('full_track_filename') ?? $track->full_track_filename }}">
	
			<button type="submit">Update Track</button>			
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