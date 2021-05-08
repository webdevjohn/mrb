@extends('cms-layout')
@section('title', 'Albums')

@section('page-header')
	<h1>
		{{ $album->title }}
		<a href="{{ route('cms.basedata.albums.tracks.create', $album->slug) }}" 
			class="btn btn-new-record float-right" 
			title="New Track to Album">Add track to Album +</a>
	</h1>	
@stop

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li><a href="{{ route('cms.basedata.albums.index') }}">Albums</a></li>	
	<li>{{ $album->title }}</li>
@stop

@section('content')

	<section class="table-con">
		<table>
			<thead>
				<tr>
					<th class="table-col-albums-tracks-title">Title</th>	
					<th class="table-col-albums-tracks-record-label">Label</th>				
					<th class="table-col-albums-tracks-purchase-date">Purchase Date</th>						
					<th>Actions</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="4"><a href="{{ route('cms.basedata.albums.tracks.create', $album->slug) }}">Add Track to Album</a></td>
				</tr>
			</tfoot>
			<tbody>
			@foreach($tracks as $track)
			<tr>
				<td>{{ $track->title }}</td>				
				<td>{{ $track->label->label }}</td>
				<td>{{ $track->purchase_date }}</td>
				<td>
					<ul class="frm-crud-buttons">
						<li>
							<a href="{{ route('cms.basedata.albums.tracks.edit', [$album->slug, $track->id]) }}" 
								class="btn btn-edit-record" title="Edit Record">Edit</a>
						</li>
					</ul>
				</td>
			</tr>	
			@endforeach
			</tbody>
		</table>
	</section>
@stop