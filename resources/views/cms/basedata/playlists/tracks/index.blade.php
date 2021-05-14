<x-cms.admin-layout>
	<x-slot name="title">Tracks for: {{ $playlist->name }}</x-slot>

	<x-slot name="pageHeader">
		{{ $playlist->name }}
		<a href="{{ route('cms.basedata.playlists.tracks.create', $playlist->slug) }}" 
			class="btn btn-new-record float-right" 
			title="Add Track to Playlist">Add track to playlist +</a>
	</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.homepage') }}">Home</a></li>
		<li><a href="{{ route('cms.basedata.index') }}">Base Data</a></li>
		<li><a href="{{ route('cms.basedata.playlists.index') }}">Playlists</a></li>
		<li>{{ $playlist->name }}</li>
	</x-slot>

	<section class="table-con">	
		<table>
			<thead>
				<tr>
					<th class="table-col-playlists-tracks-title">Title</th>	
					<th class="table-col-playlists-tracks-label">Label</th>													
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="4"><a href="{{ route('cms.basedata.playlists.tracks.create', $playlist->slug) }}">Add Track to Playlist</a></td>
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
</x-cms.admin-layout>