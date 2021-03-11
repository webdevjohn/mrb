@extends('master-layout')
@section('title', 'My Record Box - Playlists')
@section('content')
	           
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
	
	{!! $playlists->links() !!}  
	
@stop