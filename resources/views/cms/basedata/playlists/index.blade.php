<x-cms.admin-layout>
	<x-slot name="title">Playlists</x-slot>

	<x-slot name="pageHeader">
		Playlists
		<a href="{{ route('cms.basedata.playlists.create') }}" 
			class="btn btn-new-record float-right" 
			title="New Playlist">New Playlist +</a>
	</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.dashboard') }}" title="Dashboard">Dashboard</a></li>
		<li><a href="{{ route('cms.basedata.index') }}" title="Base Data">Base Data</a></li>
		<li>Playlists</li>	
	</x-slot>

	<section class="table-con">
		<table>
			<thead>
				<tr>
					<th class="table-col-playlists-name">Name</th>								
					<th>Actions</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="5"><a href="{{ route('cms.basedata.playlists.create') }}">Create a New Playlist</a></td>
				</tr>
			</tfoot>
			<tbody>
				@foreach($playlists as $playlist)
				<tr>
					<td>{{ $playlist->name }}</td>	
					<td>
						<ul class="frm-crud-buttons">
							<li>
								<a href="{{ route('cms.basedata.playlists.tracks.index', $playlist->slug) }}" 
									class="btn btn-view-record" 
									title="View Tracks">View Tracks</a>								
							</li>
							<li>
								<a href="{{ route('cms.basedata.playlists.edit', $playlist->slug) }}" 
									class="btn btn-edit-record" 
									title="Edit Record">Edit</a>
							</li>
						</ul>
					</td>
				</tr>	
				@endforeach
			</tbody>
		</table>
	</section>

	<x-cms.pagination :model="$playlists" />
	
</x-cms.admin-layout>