<x-cms.admin-layout>
	<x-slot name="title">Labels</x-slot>

	<x-slot name="pageHeader">
		Labels
		<a href="{{ route('cms.basedata.labels.create') }}" 
			class="btn btn-new-record float-right" 
			title="New Label">New Label +</a>
	</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.dashboard') }}" title="Dashboard">Dashboard</a></li>
		<li><a href="{{ route('cms.basedata.index') }}" title="Base Data">Base Data</a></li>
		<li>Labels</li>
	</x-slot>

	<section class="table-con">
		{{-- <section id="table-actions">
			<ul>
				<li><a href="#">Filters</a></li>
				<li><a href="{{ route('cms.basedata.labels.create') }}" class="btn btn-new-record" title="New Label">New Label +</a></li>
			</ul>
		</section> --}}

		<table>
			<thead>
				<tr>
					<th class="table-col-labels-label">Label</th>		
					<th class="table-col-labels-thumbnail">Thumbnail</th>		
					<th class="table-col-labels-main-image">Main Image</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="4"><a href="{{ route('cms.basedata.labels.create') }}">Create a New Label</a></td>
				</tr>
			</tfoot>
			<tbody>
				@foreach($labels as $label)
				<tr>
					<td>{{ $label->label }}</td>	
					<td>{{ $label->thumbnail }}</td>		
					<td>{{ $label->image }}</td>	
					<td>
						<ul class="frm-crud-buttons">
							<li>
								<a href="{{ route('cms.basedata.labels.edit', $label->slug) }}" 
									class="btn btn-edit-record" title="Edit Record">Edit</a>
							</li>
						</ul>
					</td>
				</tr>	
				@endforeach
			</tbody>
		</table>
	</section>

	<x-cms.pagination :model="$labels" />
	
</x-cms.admin-layout>