@extends('master-layout')
@section('title', 'My Record Box -' . $playlist->name)
@section('content')

	<h1 id="page-header">
		<div class="wrapper">{{ $playlist->name }}</div>
	</h1>

	<section class="track-listings wrapper">
		@include('_partials.tracks', ['tracks' => $tracks])				
	</section> 						
	 
	<section>
		{!! $tracks->appends(request()->input())->render() !!}	
	</section>
	
@stop