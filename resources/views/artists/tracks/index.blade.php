<x-app-layout>
	<x-slot name="title">{{ $artist->artist_name }}</x-slot>

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

</x-app-layout>