@extends('cms-layout')
@section('title', 'Create a New Track')

@section('breadcrums')
	<li><a href="{{ URL::route('cms.homepage') }}">Home</a></li>
	<li>&gt;  &nbsp;</li>
	<li><a href="{{ URL::route('cms.playlists.index') }}">Playlists</a></li>
	<li>&gt;  &nbsp;</li>
	<li><a href="{{ URL::route('cms.playlists.tracks.index', $playlistTracks->slug) }}">{{ $playlistTracks->name }}</a></li>
	<li>&gt;</li>
	<li class="active-breadcrum">Add tracks to playlist</li>
@stop

@section('content')
	

	<section class="table-con">
			<h1 class="section-header">{{ $playlistTracks->name }}</h1>

			<table>
				<thead>
					<tr>
						<th>Artist</th>
						<th>Title</th>	
						<th>Label</th>	
						<th>Year Released</th>	
						<th>Actions</th>												
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="4"></td>
					</tr>
				</tfoot>
				<tbody>
				@foreach($tracks as $track)
				<tr>
					<td> 
						@foreach($track->Artists as $artist)
							{{ $artist->artist_name }}
						@endforeach
					</td>
					<td>{{ $track->title }}</td>				
					<td>{{ $track->Label->label }}</td>		
					<td>{{ $track->year_released }}</td>						
					<td>
						<form method="POST" action="{{ route('cms.playlists.tracks.store', $playlistTracks->slug) }}">
							{{ csrf_field() }}
							
							<input name="id" type="hidden" id="id" value="{{ $track->id}}">
							<button type="submit">Add Track to Playlist</button>
						</form>
					</td>
				</tr>	
				@endforeach
				</tbody>
			</table>
		</section>

		{!! $tracks->appends(request()->input())->render() !!}	
@stop

@section('javascript')
	<script>

	</script>
@stop