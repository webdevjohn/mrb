<x-app-layout>
	<x-slot name="title">{{ $playlist->name }}</x-slot>

	<h1 id="page-header">
		<div class="wrapper">{{ $playlist->name }}</div>
	</h1>

	<section class="track-listings wrapper">
		@include('_partials.tracks', ['tracks' => $tracks])				
	</section> 						
	 
	<section>
		{!! $tracks->appends(request()->input())->render() !!}	
	</section>
	
</x-app-layout>