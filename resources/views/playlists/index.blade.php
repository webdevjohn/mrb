<x-app-layout>
	<x-slot name="title">Playlists</x-slot>
	           
	<x-page-header>Playlists</x-page-header>

	<div class="wrapper">
		<section id="playlist-grid">
		@foreach ($playlists as $playlist) 
			<article>
				<a href="{{ route('playlists.tracks.index', $playlist->slug) }}" title="View {{ $playlist->name }} Tracks">			
					<img src="{{ asset($playlist->getThumbnail()) }}" alt="{{ $playlist->name }}">
				</a>
				<footer>
					<a href="{{ route('playlists.tracks.index', $playlist->slug) }}" title="View {{ $playlist->name }} Tracks">			
						{{ $playlist->name }}
					</a>
				</footer>
			</article>
		@endforeach
		</section>
	</div>
	
	<x-pagination :model="$playlists" />

</x-app-layout>