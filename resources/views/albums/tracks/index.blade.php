@extends('master-layout')
@section('title', 'My Record Box - ' . $album->title)
@section('content')
	           
	<h1 id="page-header">
		<div class="wrapper">{{ $album->title }}</div>
	</h1>

	<section class="track-listings wrapper">						
		@include('_partials.tracks', ['tracks' => $tracks])		
	</section>
@stop