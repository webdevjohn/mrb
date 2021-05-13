<x-app-layout>
	<x-slot name="title">{{ $artist->artist_name }}</x-slot>

	<x-page-header>{{ $artist->artist_name }}</x-page-header>

	<div class="wrapper">
		<section class="track-listings">				
			@include('_partials.tracks', ['tracks' => $artistTracks])				
		</section> 					
 	</div>

	<x-pagination :model="$artistTracks" />

</x-app-layout>