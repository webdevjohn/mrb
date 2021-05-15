<x-cms.admin-layout>
	<x-slot name="title">Formats</x-slot>

	<x-slot name="pageHeader">
		Formats
		<a href="{{ route('cms.basedata.formats.create') }}" 
			class="btn btn-new-record float-right" 
			title="New Format">New Format +</a>
	</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.dashboard') }}" title="Dashboard">Dashboard</a></li>
		<li><a href="{{ route('cms.basedata.index') }}" title="Base Data">Base Data</a></li>
		<li>Formats</li>
	</x-slot>

	<section class="table-con">
		<table>
			<thead>
				<tr>
					<th class="table-col-formats-format">Format</th>				
					<th>Actions</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="2"><a href="{{ route('cms.basedata.formats.create') }}">Create a New Format</a></td>
				</tr>
			</tfoot>
			<tbody>
				@foreach($formats as $format)
				<tr>
					<td>{{ $format->format }}</td>				
					<td>
						<ul class="frm-crud-buttons">
							<li>
								<a href="{{ route('cms.basedata.formats.edit', $format->id) }}" class="btn btn-edit-record" title="Edit Record">Edit</a>
							</li>
						</ul>
					</td>
				</tr>	
				@endforeach
			</tbody>
		</table>
	</section>
	
	<x-cms.pagination :model="$formats" />

</x-cms.admin-layout>