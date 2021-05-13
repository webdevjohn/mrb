<x-app-layout>
    <x-slot name="title">{{ $album->title }}</x-slot>
	           
	<h1 id="page-header">
		<div class="wrapper">{{ $album->title }}</div>
	</h1>

	<section class="track-listings wrapper">						
		@include('_partials.tracks', ['tracks' => $tracks])		
	</section>
</x-app-layout>