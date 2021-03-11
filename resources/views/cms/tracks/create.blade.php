@extends('cms-layout')
@section('title', 'Create a New Track')

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li>&gt;  &nbsp;</li>
	<li><a href="{{ route('cms.tracks.index') }}">Tracks</a></li>
	<li>&gt;</li>
	<li class="active-breadcrum">Create a New Track</li>
@stop

@section('content')
	
	<h1 class="section-header">Create a New Track</h1>

	<section id="form-con">		

		{!! Form::open(array('method' => 'post', 'route' => array('cms.tracks.store'))) !!}

			{!! Form::label('artists', 'Artist: ') !!}
			{!! Form::select('artists[]', $artistList, null, ['id' => 'artists', 'multiple']) !!}
			{!! $errors->first('artists', '<span class="form-input-error">:message</span>') !!}

			{!! Form::label('title', 'Title: ') !!}
			{!! Form::text('title') !!}
			{!! $errors->first('title', '<span class="form-input-error">:message</span>') !!}

			{!! Form::label('genre_id', 'Genre: ') !!}
			{!! Form::select('genre_id', $genreList) !!}
			{!! $errors->first('genre_id', '<span class="form-input-error">:message</span>') !!}

			{!! Form::label('label_id', 'Label: ') !!}
			{!! Form::select('label_id', $labelList) !!}
			{!! $errors->first('label_id', '<span class="form-input-error">:message</span>') !!}

			{!! Form::label('format_id', 'Format: ') !!}
			{!! Form::select('format_id', $formatList) !!}
			{!! $errors->first('format_id', '<span class="form-input-error">:message</span>') !!}

			{!! Form::label('year_released', 'Year Released: ') !!}
			{!! Form::text('year_released') !!}
			{!! $errors->first('year_released', '<span class="form-input-error">:message</span>') !!}

			{!! Form::label('purchase_date', 'Purchase Date: ') !!}
			{!! Form::text('purchase_date') !!}
			{!! $errors->first('purchase_date', '<span class="form-input-error">:message</span>') !!}

			{!! Form::label('purchase_price', 'Purchase Price: ') !!}
			{!! Form::text('purchase_price') !!}
			{!! $errors->first('purchase_price', '<span class="form-input-error">:message</span>') !!}

			{!! Form::label('tags', 'Tags: ') !!}
			{!! Form::select('tags[]', $tagList, null, ['id' => 'tags', 'multiple']) !!}
			{!! $errors->first('tags', '<span class="form-input-error">:message</span>') !!}

			{!! Form::button('Create Track', array('type' => 'submit')) !!}
		
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