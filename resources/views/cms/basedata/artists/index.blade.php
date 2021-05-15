<x-cms.admin-layout>
	<x-slot name="title">Artists</x-slot>

	<x-slot name="pageHeader">
		Artists
		<a href="{{ route('cms.basedata.artists.create') }}" 
			class="btn btn-new-record float-right" 
			title="New Artist">New Artist +</a>
	</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.dashboard') }}" title="Dashboard">Dashboard</a></li>
		<li><a href="{{ route('cms.basedata.index') }}" title="Base Data">Base Data</a></li>
		<li>Artists</li>
	</x-slot>
	
	<section class="table-con">
		<table>
			<thead>
				<tr>
					<th class="table-col-artists-artist">Artist</th>					
					<th>Actions</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="2"><a href="{{ route('cms.basedata.artists.create') }}">Create a New Artist</a></td>
				</tr>
			</tfoot>
			<tbody>
				@foreach($artists as $artist)
				<tr>
					<td>{{ $artist->artist_name }}</td>				
					<td>						
						<ul class="frm-crud-buttons">
							<li>
								<a href="{{ route('cms.basedata.artists.edit', $artist->slug) }}" class="btn btn-edit-record" title="Edit Record">Edit</a>
							</li>
						</ul>
					</td>
				</tr>	
				@endforeach
			</tbody>
		</table>
	</section>

	<x-cms.pagination :model="$artists" />
	
</x-cms.admin-layout>