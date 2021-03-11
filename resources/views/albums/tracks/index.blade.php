@extends('master-layout')
@section('title', 'My Record Box - ' . $album->title)
@section('content')
	           
	<h1 id="page-header">
		<div class="wrapper">{{ $album->title }}</div>
	</h1>

	<div class="wrapper">
		<section class="track-listings">						
			@include('_partials.tracks', ['tracks' => $album->Tracks])		
		</section>
	</div>

@stop