@extends('master-layout')
@section('title', 'My Record Box - Genres')
@section('content')

  	<h1 id="page-header">
		<div class="wrapper">Genres</div>
	</h1>
	
	<div class="wrapper">
		<section id="genre-list-gird">
			@foreach ($genres as $genre) 
				<article> 
					<h1 class="{{ $genre->slug }}">{{ $genre->genre }}</h1>
					<ul>
						<li>
							<a href="{{route('genres.show', $genre->slug)}}" class="icon-home">Home Page</a>
						</li>
						<li>
							<a href="{{ route('genres.tracks.index', $genre->slug) }}" class="icon-music" title="View all {{ $genre->genre }} tracks">
								Tracks <span>{{ "(" . $genre->track_count . ")" }}</span>
							</a>
						</li>				
					</ul>
				</article>
			@endforeach
		</section>
	</div>
@stop