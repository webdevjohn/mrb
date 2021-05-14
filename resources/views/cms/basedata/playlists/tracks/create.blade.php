<x-cms.admin-layout>
	<x-slot name="title">Add track to: {{ $playlist->name }}</x-slot>

	<x-slot name="pageHeader">{{ $playlist->name }}</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.homepage') }}">Home</a></li>
		<li><a href="{{ route('cms.basedata.index') }}">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.playlists.index') }}">Playlists</a></li>	
		<li><a href="{{ route('cms.basedata.playlists.tracks.index', $playlist->slug) }}">{{ $playlist->name }}</a></li>
		<li>Add track to playlist</li>
	</x-slot>
	
	<section class="table-con">
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
					@foreach($track->artists as $artist)
						{{ $artist->artist_name }}
					@endforeach
				</td>
				<td>{{ $track->title }}</td>				
				<td>{{ $track->label->label }}</td>		
				<td>{{ $track->year_released }}</td>						
				<td>					
					<form method="POST" action="{{ route('cms.basedata.playlists.tracks.store', $playlist->slug) }}">
						@csrf
						
						<input name="id" type="hidden" id="id" value="{{ $track->id }}">
						<button type="submit">Add Track to Playlist</button>
					</form>						
				</td>
			</tr>	
			@endforeach
			</tbody>
		</table>
	</section>

	{!! $tracks->appends(request()->input())->render() !!}	

</x-cms.admin-layout>