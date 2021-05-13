<x-app-layout>
    <x-slot name="title">{{ $album->title }}</x-slot>
	           
	<x-page-header>{{ $album->title }}</x-page-header>

	<div class="wrapper">
		<section class="track-listings">						
			@include('_partials.tracks', ['tracks' => $tracks])		
		</section>
	</div>

</x-app-layout>