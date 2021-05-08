@extends('cms-layout')
@section('title', 'Formats')

@section('page-header')
	<h1>
		Formats
		<a href="{{ route('cms.basedata.formats.create') }}" 
			class="btn btn-new-record float-right" 
			title="New Format">New Format +</a>
	</h1>	
@stop

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li>Formats</li>
@stop

@section('content')

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
	{!! $formats->appends(request()->input())->render() !!}	
@stop