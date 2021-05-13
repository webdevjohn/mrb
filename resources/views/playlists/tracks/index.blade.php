<x-app-layout>
	<x-slot name="title">{{ $playlist->name }}</x-slot>

	<x-page-header>{{ $playlist->name }}</x-page-header>

	<section class="track-listings wrapper">
		@include('_partials.tracks', ['tracks' => $tracks])				
	</section> 						
	 
	<section>
		{!! $tracks->appends(request()->input())->render() !!}	
	</section>
	
</x-app-layout>