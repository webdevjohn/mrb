@extends('master-layout')
@section('title', 'My Record Box -' . $artist->artist_name)
@section('content')

	<h1 id="page-header">
		<div class="wrapper">{{ $artist->artist_name }}</div>
	</h1>

	<div class="wrapper">
		<section class="track-listings">				
			@include('_partials.tracks', ['tracks' => $artistTracks])				
		</section> 					
 	</div>

	<section>
		{!! $artistTracks->appends(request()->input())->render() !!}	
	</section>

@stop