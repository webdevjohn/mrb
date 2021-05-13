<x-app-layout>
	<x-slot name="title">Artists</x-slot>

	<x-page-header>Artists</x-page-header>

	<section id="artist-list-gird">	
		@foreach ($artists as $artist) 
			<article>
				<a href="{{ route('artists.tracks.index', $artist->slug) }}" title="View {{ $artist->artist_name }} Tracks">
					{{ $artist->artist_name }}<span>&#40;{{ $artist->track_count }}&#41;</span>
				</a>		
			</article>
		@endforeach		
	</section>

	<x-pagination :model="$artists" />	
</x-app-layout>