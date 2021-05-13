<x-app-layout>
	<x-slot name="title">{{ $label->label }}</x-slot>

	<x-page-header>{{ $label->label }}</x-page-header>

	<div class="wrapper">
		<section class="track-listings">
			@include('_partials.tracks', ['tracks' => $tracks])
		</section> 					
 	</div>

	<section>
		{!! $tracks->appends(request()->input())->render() !!}	
	</section>
	
</x-app-layout>