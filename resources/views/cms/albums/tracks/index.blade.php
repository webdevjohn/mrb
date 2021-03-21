@extends('cms-layout')
@section('title', 'Albums')

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li><a href="{{ route('cms.albums.index') }}">Albums</a></li>	
	<li class="last">{{ $album->title }}</li>
@stop

@section('content')

	<section class="table-con">

		<a href="{{ route('cms.albums.tracks.create', $album->slug) }}" class="btn btn-new-record float-right" title="New Record">New Record +</a>
		
		<h1 class="section-header">{{ $album->title }}</h1>

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
					<td colspan="4"><a href="{{ route('cms.albums.tracks.create', $album->slug) }}">Add Track to Album</a></td>
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
							<a href="{{ route('cms.albums.tracks.edit', [$album->slug, $track->id]) }}" class="btn btn-edit-record" title="Edit Record">Edit</a>
						</li>
					</ul>
				</td>
			</tr>	
			@endforeach
			</tbody>
		</table>
	</section>
@stop