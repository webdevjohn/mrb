<x-app-layout>
	<x-slot name="title">{{ $genre->genre }}</x-slot>
 
	<div id="homepage-layout" class="wrapper">
		<section id="main">
			<h1 class="section-header">Popular Tracks 
				<a href="{{ route('genres.tracks.index', $genre->slug) }}" 
					class="{{ $genre->slug }}-bg" 
					title="View all {{ $genre->genre }} tracks">
						{{ $genre->genre }}
				</a>
			</h1> 
			<x-track-listings :tracks="$popularTracks" /> 	
		</section>
		<section>
			<h1 class="section-header">Popular Labels</h1>
			<section id="popular-labels">
				@foreach($labelsWithMostTracks as $label)
				<article>
					<a href="{{ route('labels.tracks.index', $label->slug) }}" title="View {{ $label->label }} Tracks">			
						<img src="{{ asset($label->getLabelImage()) }}" alt="{{$label->title}}">
					</a>
					<h2>{{ $label->label }}</h2>
				</article>
				@endforeach
			</section>
		</section>
 	</div>
</x-app-layout>