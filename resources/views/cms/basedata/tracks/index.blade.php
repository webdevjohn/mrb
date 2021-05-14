<x-cms.admin-layout>
	<x-slot name="title">Tracks</x-slot>

	<x-slot name="pageHeader">
		Tracks
		<a href="{{ route('cms.basedata.tracks.create') }}" 
			class="btn btn-new-record float-right" 
			title="New Track">New Track +</a>
	</x-slot>

	<x-slot name="breadcrumbs">
		<li><a href="{{ route('cms.homepage') }}">Home</a></li>
		<li><a href="{{ route('cms.basedata.index') }}">Base Data</a></li>
		<li>Tracks</li>
	</x-slot>

	<section class="table-con">
		<table>
			<thead>
				<tr>
					<th class="table-col-title">Title</th>				
					<th class="table-col-record-label">Record Label</th>	
					<th class="table-col-purchase-date">Purchase Date</th>						
					<th>Actions</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="4"><a href="{{ route('cms.basedata.tracks.create') }}">Create a New Track</a></td>
				</tr>
			</tfoot>
			<tbody>
				@foreach($tracks as $track)
				<tr>
					<td>{{ $track->title }}</td>				
					<td>{{ $track->Label->label }}</td>
					<td>{{ $track->purchase_date }}</td>
					<td>
						<ul class="frm-crud-buttons">			
							<li>
								<a href="{{ route('cms.basedata.tracks.edit', $track->id) }}" class="btn btn-edit-record" title="Edit Record">Edit</a>
							</li>
						</ul>
					</td>
				</tr>	
				@endforeach
			</tbody>
		</table>
	</section>

	{!! $tracks->appends(request()->input())->render() !!}	
</x-cms.admin-layout>