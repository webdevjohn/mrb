<x-app-layout>
    <x-slot name="title">Albums</x-slot>
	           
	<x-page-header>Albums</x-page-header>

	<section id="album-list-gird">
		@foreach ($albums as $album) 
		<article>
			<a href="{{ route('albums.tracks.index', $album->slug) }}" title="View {{ $album->title }} Tracks">
				<img src="{{ asset($album->getAlbumImage()) }}" alt="{{ $album->title}}">
			</a>
			<footer>
				<a href="{{ route('albums.tracks.index', $album->slug) }}" title="View {{ $album->title }} Tracks">
					{{ $album->title }}
				</a>
			</footer>
		</article>
		@endforeach
	</section>

	<x-pagination :model="$albums" />

</x-app-layout>