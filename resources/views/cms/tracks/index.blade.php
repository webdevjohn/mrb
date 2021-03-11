@extends('cms-layout')
@section('title', 'Tracks')

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li>&gt;</li>
	<li class="active-breadcrum">Tracks</li>
@stop

@section('content')

	<section class="table-con">

		<a href="{{ route('cms.tracks.create') }}" class="btn btn-new-record float-right" title="New Record">New Record +</a>

		<h1 class="section-header">Tracks</h1>

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
					<td colspan="4"><a href="{{ route('cms.tracks.create') }}">Create a New Track</a></td>
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
							{{-- <li>
								<a href="{{ route('cms.tracks.show', $track->id) }}" class="btn btn-view-record" title="View Record">View</a>								
							</li> --}}
							<li>
								<a href="{{ route('cms.tracks.edit', $track->id) }}" class="btn btn-edit-record" title="Edit Record">Edit</a>
							</li>
						</ul>
					</td>
				</tr>	
				@endforeach
			</tbody>
		</table>
	</section>
	{!! $tracks->appends(request()->input())->render() !!}	
@stop