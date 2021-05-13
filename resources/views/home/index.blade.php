<x-app-layout>
    <x-slot name="title">Homepage</x-slot>

	<section id="homepage-layout">
		<section id="main">

			<h1 class="section-header">Playlists</h1> 
			<section id="playlists">
				@foreach($playlists as $playList)
				<article>		
					<a href="{{ route('playlists.tracks.index', $playList->slug) }}">			
						<img src="{{ asset($playList->getThumbnail()) }}" alt="">			
					</a>
					<footer>
						<a href="{{ route('playlists.tracks.index', $playList->slug) }}" title="View {{ $playList->name }} Tracks">			
							{{ $playList->name }}
						</a>
					</footer>
				</article>
				@endforeach	
			</section>
	
			<section id="latest-tracks">	
				<h1 class="section-header">Latest Tracks</h1>
				<x-track-listings :tracks="$latestTracks" /> 	
			</section> 		

			<section id="popular-tracks">	
				<h1 class="section-header">Popular Tracks</h1>	
				<x-track-listings :tracks="$popularTracks" /> 	
			</section>				
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

	</section>
</x-app-layout>