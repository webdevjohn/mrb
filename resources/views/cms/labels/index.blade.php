@extends('cms-layout')
@section('title', 'Labels')

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li>&gt;</li>
	<li class="active-breadcrum">{{ $page }}</li>
@stop

@section('content')

	<section class="table-con">

		<a href="{{ route('cms.labels.create') }}" class="btn btn-new-record float-right" title="New Record">New Record +</a>
	
		<h1 class="section-header">Labels</h1>

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
								<a href="{{ route('cms.labels.edit', $label->id) }}" class="btn btn-edit-record" title="Edit Record">Edit</a>
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