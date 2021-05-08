@extends('cms-layout')
@section('title', 'Labels')

@section('page-header')
	<h1>
		Labels
		<a href="{{ route('cms.labels.create') }}" 
			class="btn btn-new-record float-right" 
			title="New Label">New Label +</a>
	</h1>	
@stop

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li>Labels</li>
@stop

@section('content')

	<section class="table-con">

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
					<td colspan="4"><a href="{{ route('cms.labels.create') }}">Create a New Label</a></td>
				</tr>
			</tfoot>
			<tbody>
				@foreach($labels as $label)
				<tr>
					<td>{{ $label->label }}</td>	
					<td>{{ $label->label_thumbnail }}</td>		
					<td>{{ $label->label_image }}</td>	
					<td>
						<ul class="frm-crud-buttons">
							<li>
								<a href="{{ route('cms.labels.edit', $label->slug) }}" class="btn btn-edit-record" title="Edit Record">Edit</a>
							</li>
						</ul>
					</td>
				</tr>	
				@endforeach
			</tbody>
		</table>
	</section>
	{!! $labels->appends(request()->input())->render() !!}	
@stop