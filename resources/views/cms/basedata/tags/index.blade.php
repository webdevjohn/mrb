<x-cms.admin-layout>
	<x-slot name="title">Tags</x-slot>

	<x-slot name="pageHeader">
		Tags
		<a href="{{ route('cms.basedata.tags.create') }}" 
			class="btn btn-new-record float-right" 
			title="New Tag">New Tag +</a>	
	</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.dashboard') }}" title="Dashboard">Dashboard</a></li>
		<li><a href="{{ route('cms.basedata.index') }}" title="Base Data">Base Data</a></li>
		<li>Tags</li>
	</x-slot>

	<section class="table-con">	
		<table>
			<thead>
				<tr>
					<th class="table-col-tags-tag">Tag</th>				
					<th>Actions</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="4"><a href="{{ route('cms.basedata.tags.create') }}">Create a New Tag</a></td>
				</tr>
			</tfoot>
			<tbody>
				@foreach($tags as $tag)
				<tr>
					<td>{{ $tag->tag }}</td>				
					<td>
						<ul class="frm-crud-buttons">
							<li>
								<a href="{{ route('cms.basedata.tags.edit', $tag->id) }}" class="btn btn-edit-record" title="Edit Record">Edit</a>
							</li>
						</ul>
					</td>
				</tr>	
				@endforeach
			</tbody>
		</table>
	</section>

	<x-cms.pagination :model="$tags" />

</x-cms.admin-layout>