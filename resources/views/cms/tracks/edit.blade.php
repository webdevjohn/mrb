@extends('cms-layout')
@section('title', 'Edit Track: ' . $track->title)

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li>&gt;  &nbsp;</li>
	<li><a href="{{ route('cms.tracks.index') }}">Tracks</a></li>
	<li>&gt;</li>
	<li class="active-breadcrum">{{ $track->title }}</li>
@stop

@section('content')
	
	<h1 class="section-header">Edit Track: {{ $track->title }}</h1>

	<section id="form-con">		
		{!! Form::open(array('method' => 'patch', 'route' => array('cms.tracks.update', $track->id))) !!}

			{!! Form::label('artists', 'Artist: ') !!}
			{!! Form::select('artists[]', $artistList, $track->getArtistIds(), ['id' => 'artists', 'multiple']) !!}
			{!! $errors->first('artists', '<span class="form-input-error">:message</span>') !!}

			{!! Form::label('title', 'Title: ') !!}
			{!! Form::text('title', $track->title) !!}
			{!! $errors->first('title', '<span class="form-input-error">:message</span>') !!}

			{!! Form::label('genre_id', 'Genre: ') !!}
			{!! Form::select('genre_id', $genreList, $track->genre_id) !!}
			{!! $errors->first('genre_id', '<span class="form-input-error">:message</span>') !!}

			{!! Form::label('label_id', 'Label: ') !!}
			{!! Form::select('label_id', $labelList, $track->label_id) !!}
			{!! $errors->first('label_id', '<span class="form-input-error">:message</span>') !!}

			{!! Form::label('format_id', 'Format: ') !!}
			{!! Form::select('format_id', $formatList, $track->format_id) !!}
			{!! $errors->first('format_id', '<span class="form-input-error">:message</span>') !!}

			{!! Form::label('year_released', 'Year Released: ') !!}
			{!! Form::text('year_released', $track->year_released) !!}
			{!! $errors->first('year_released', '<span class="form-input-error">:message</span>') !!}

			{!! Form::label('purchase_date', 'Purchase Date: ') !!}
			{!! Form::text('purchase_date', $track->purchase_date) !!}
			{!! $errors->first('purchase_date', '<span class="form-input-error">:message</span>') !!}

			{!! Form::label('purchase_price', 'Purchase Price: ') !!}
			{!! Form::text('purchase_price', $track->purchase_price) !!}
			{!! $errors->first('purchase_price', '<span class="form-input-error">:message</span>') !!}

			{!! Form::label('tags', 'Tags: ') !!}
			{!! Form::select('tags[]', $tagList, $track->getTagIds(), ['id' => 'tags', 'multiple']) !!}
			{!! $errors->first('tags', '<span class="form-input-error">:message</span>') !!}

			<hr />
	
			{!! Form::label('track_thumbnail', 'Track Thumbnail: ') !!}
			{!! Form::text('track_thumbnail', $track->track_thumbnail) !!}
			{!! $errors->first('track_thumbnail', '<span class="form-input-error">:message</span>') !!}
		
			{!! Form::label('track_image', 'Track Main Image: ') !!}
			{!! Form::text('track_image', $track->track_image) !!}
			{!! $errors->first('track_image', '<span class="form-input-error">:message</span>') !!}

			<hr />

			{!! Form::label('mp3_sample_filename', 'MP3 Filename: ') !!}
			{!! Form::text('mp3_sample_filename', $track->mp3_sample_filename) !!}
			{!! $errors->first('mp3_sample_filename', '<span class="form-input-error">:message</span>') !!}

			{!! Form::label('full_track_filename', 'WAV Filename: ') !!}
			{!! Form::text('full_track_filename', $track->full_track_filename) !!}
			{!! $errors->first('full_track_filename', '<span class="form-input-error">:message</span>') !!}

			{!! Form::hidden('id', $track->id) !!}
			{!! Form::button('Update', array('type' => 'submit')) !!}
		
		{!! Form::close() !!}
	</section>
@stop

@section('javascript')
	<script>
		$('#artists').select2({
			 placeholder: "Select Artists"
		});

		$('#tags').select2({
			 placeholder: "Select Tags"
		});
	</script>
@stop