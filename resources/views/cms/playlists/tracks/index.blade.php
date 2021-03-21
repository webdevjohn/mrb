@extends('cms-layout')
@section('title', 'Albums')

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li><a href="{{ route('cms.playlists.index') }}">Playlists</a></li>
	<li class="last">{{ $playlist->name }}</li>
@stop

@section('content')

	<section class="table-con">

		<a href="{{ route('cms.playlists.tracks.create', $playlist->slug) }}" class="btn btn-new-record float-right" title="New Record">New Record +</a>

		<h1 class="section-header">{{ $playlist->name }}</h1>

		<table>
			<thead>
				<tr>
					<th class="table-col-playlists-tracks-title">Title</th>	
					<th class="table-col-playlists-tracks-label">Label</th>													
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="4"><a href="{{ route('cms.playlists.tracks.create', $playlist->slug) }}">Add Track to Playlist</a></td>
				</tr>
			</tfoot>
			<tbody>
			@foreach($playlist->tracks as $tracks)
			<tr>
				<td>{{ $tracks->title }}</td>				
				<td>{{ $tracks->label->label }}</td>					
			</tr>	
			@endforeach
			</tbody>
		</table>
	</section>
@stop