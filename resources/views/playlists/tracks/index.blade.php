@extends('master-layout')
@section('title', 'My Record Box -' . $playlist->name)
@section('content')


	<h1 id="page-header">
		<div class="wrapper">{{ $playlist->name }}</div>
	</h1>
	
	<div class="wrapper">
		<section class="track-listings">
			@include('_partials.tracks', ['tracks' => $playlistTracks])				
		</section> 						
	</div>
	 
	<section>
		{!! $playlistTracks->appends(request()->input())->render() !!}	
	</section>
	
@stop