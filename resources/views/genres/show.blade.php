@extends('master-layout')
@section('title', 'My Record Box -' . $genre->genre)
@section('content')
 
	<div id="homepage-layout" class="wrapper">
		<section id="main">
			<h1 class="section-header">Popular Tracks 
				<a href="{{ route('genres.tracks.index', $genre->slug) }}" 
					class="{{ $genre->slug }}-bg" 
					title="View all {{ $genre->genre }} tracks">
						{{ $genre->genre }}
				</a>
			</h1> 
			<section class="track-listings">
				@include('_partials.tracks', ['tracks' => $popularTracks])				
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
 	</div>
@stop