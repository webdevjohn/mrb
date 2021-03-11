@extends('cms-layout')
@section('title', 'Formats')

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li>&gt;</li>
	<li class="active-breadcrum">{{ $page }}</li>
@stop

@section('content')

	<section class="table-con">

		<a href="{{ route('cms.formats.create') }}" class="btn btn-new-record float-right" title="New Record">New Record +</a>
		
		<h1 class="section-header">Formats</h1>

		<table>
			<thead>
				<tr>
					<th class="table-col-formats-format">Format</th>				
					<th>Actions</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="2"><a href="{{ route('cms.formats.create') }}">Create a New Format</a></td>
				</tr>
			</tfoot>
			<tbody>
				@foreach($formats as $format)
				<tr>
					<td>{{ $format->format }}</td>				
					<td>
						<ul class="frm-crud-buttons">
							<li>
								<a href="{{ route('cms.formats.edit', $format->id) }}" class="btn btn-edit-record" title="Edit Record">Edit</a>
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