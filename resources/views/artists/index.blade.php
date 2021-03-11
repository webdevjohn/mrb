@extends('master-layout')
@section('title', 'My Record Box - Artists')
@section('content')

	<h1 id="page-header">
		<div class="wrapper">Artists</div>
	</h1>

	<div class="wrapper">
		<section id="artist-list-gird">	
			@foreach ($artists as $artist) 
				<article>
					<a href="{{ route('artists.tracks.index', $artist->slug) }}" title="View {{ $artist->artist_name }} Tracks">
						{{ $artist->artist_name }}<span>&#40;{{ $artist->track_count }}&#41;</span>
					</a>		
				</article>
			@endforeach		
		</section>
	</div>

	{!! $artists->appends(request()->input())->render() !!}	
	
 @stop