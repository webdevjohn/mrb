@extends('master-layout')
@section('title', 'My Record Box - Albums')
@section('content')
	           
	<h1 id="page-header">
		<div class="wrapper">Albums</div>
	</h1>

	<div class="wrapper">
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
	</div>

	{!! $albums->appends(request()->input())->render() !!}	

@stop