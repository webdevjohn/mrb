@extends('cms-layout')
@section('title', 'Base Data')

@section('page-header')
	<h1>Base Data</h1>	
@stop

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li>Base Data</li>
@stop

@section('content')

	<section id="basedata-list">
		<article>		
			<h1>Albums <span>({{ $recordCount->albums }})</span></h1>
			<div></div>	
			<footer>
				<a href="{{ route('cms.basedata.albums.index') }}">View Albums</a>
				<a href="{{ route('cms.basedata.albums.create') }}">New Album +</a>
			</footer>			
		</article>
		<article>
			<h1>Artists <span>({{ $recordCount->artists }})</span></h1>
			<div></div>	
			<footer>
				<a href="{{ route('cms.basedata.artists.index') }}">View Artists</a>
				<a href="{{ route('cms.basedata.artists.create') }}">New Artist +</a>
			</footer>
		</article>
		<article>
			<h1>Formats <span>({{ $recordCount->formats }})</span></h1>
			<div></div>	
			<footer>
				<a href="{{ route('cms.basedata.formats.index') }}">Formats</a>
				<a href="{{ route('cms.basedata.formats.create') }}">New Format +</a>
			</footer>
		</article>
		<article>
			<h1>Genres <span>({{ $recordCount->genres }})</span></h1>
			<div></div>	
			<footer>
				<a href="{{ route('cms.basedata.genres.index') }}">Genres</a>
				<a href="{{ route('cms.basedata.genres.create') }}">New Genre +</a>
			</footer>
		</article>
		<article>
			<h1>Labels <span>({{ $recordCount->labels }})</span></h1>
			<div></div>	
			<footer>
				<a href="{{ route('cms.basedata.labels.index') }}">Labels</a>
				<a href="{{ route('cms.basedata.labels.create') }}">New Label +</a>
			</footer>
		</article>
		<article>
			<h1>Playlists <span>({{ $recordCount->playlists }})</span></h1>
			<div></div>	
			<footer>
				<a href="{{ route('cms.basedata.playlists.index') }}">Playlists</a>
				<a href="{{ route('cms.basedata.playlists.create') }}">New Playlist +</a>
			</footer>
		</article>
		<article>
			<h1>Tags <span>({{ $recordCount->tags }})</span></h1>
			<div></div>	
			<footer>
				<a href="{{ route('cms.basedata.tags.index') }}">Tags</a>
				<a href="{{ route('cms.basedata.tags.create') }}">New Tag +</a>
			</footer>
		</article>
		<article>
			<h1>Tracks <span>({{ $recordCount->tracks }})</span></h1>
			<div></div>	
			<footer>
				<a href="{{ route('cms.basedata.tracks.index') }}">Tracks</a>
				<a href="{{ route('cms.basedata.tracks.create') }}">New Track +</a>
			</footer>
		</article>
	</section>

@stop