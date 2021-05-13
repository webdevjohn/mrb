<x-app-layout>
	<x-slot name="title">{{ $playlist->name }}</x-slot>

	<x-page-header>{{ $playlist->name }}</x-page-header>

	<div class="wrapper">
		<section class="track-listings">
			@include('_partials.tracks', ['tracks' => $tracks])				
		</section> 			
	</div>			
	 
	<x-pagination :model="$tracks" />
	
</x-app-layout>