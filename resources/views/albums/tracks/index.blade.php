<x-app-layout>
    <x-slot name="title">{{ $album->title }}</x-slot>
	           
	<x-page-header>{{ $album->title }}</x-page-header>

	<section class="track-listings wrapper">						
		@include('_partials.tracks', ['tracks' => $tracks])		
	</section>

</x-app-layout>