<x-cms.admin-layout>
	<x-slot name="title">Genres</x-slot>

	<x-slot name="pageHeader">
		Genres
		<a href="{{ route('cms.basedata.genres.create') }}" 
			class="btn btn-new-record float-right" 
			title="New Genre">New Genre +</a>
	</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.homepage') }}">Home</a></li>
		<li><a href="{{ route('cms.basedata.index') }}">Base Data</a></li>
		<li>Genres</li>
	</x-slot>

	<section class="table-con">
		<table>
			<thead>
				<tr>
					<th class="table-col-genres-genre">Genre</th>				
					<th>Actions</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="2"><a href="{{ route('cms.basedata.genres.create') }}">Create a New Genre</a></td>
				</tr>
			</tfoot>
			<tbody>
				@foreach($genres as $genre)
				<tr>
					<td>{{ $genre->genre }}</td>				
					<td>
						<ul class="frm-crud-buttons">
							<li>
								<a href="{{ route('cms.basedata.genres.edit', $genre->slug) }}" 
									class="btn btn-edit-record" title="Edit Record">Edit</a>
							</li>
						</ul>
					</td>
				</tr>	
				@endforeach
			</tbody>
		</table>
	</section>

	<x-cms.pagination :model="$genres" />
	
</x-cms.admin-layout>