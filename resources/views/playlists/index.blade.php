<x-app-layout>
	<x-slot name="title">Playlists</x-slot>
	           
	<h1 id="page-header">
		<div class="wrapper">Playlists</div>
	</h1>

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
	
	<section>
		{!! $playlists->appends(request()->input())->render() !!}	
	</section>

</x-app-layout>