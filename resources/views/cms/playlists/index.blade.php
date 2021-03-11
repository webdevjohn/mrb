@extends('cms-layout')
@section('title', 'Playlists')

@section('breadcrums')	
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li>&gt;</li>
	<li class="active-breadcrum">Playlists</li>	
@stop

@section('content')

	<section class="table-con">

		<a href="{{ route('cms.playlists.create') }}" class="btn btn-new-record float-right" title="New Record">New Record +</a>
		
		<h1 class="section-header">Playlists</h1>

		<table>
			<thead>
				<tr>
					<th class="table-col-playlists-name">Name</th>								
					<th>Actions</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="5"><a href="{{ route('cms.playlists.create') }}">Create a New Playlist</a></td>
				</tr>
			</tfoot>
			<tbody>
				@foreach($playlists as $playlist)
				<tr>
					<td>{{ $playlist->name }}</td>	
					<td>
						<ul class="frm-crud-buttons">
							<li>
								<a href="{{ route('cms.playlists.tracks.index', $playlist->slug) }}" class="btn btn-view-record" title="View Record">View</a>								
							</li>
							<li>
								<a href="{{ route('cms.playlists.edit', $playlist->slug) }}" class="btn btn-edit-record" title="Edit Record">Edit</a>
							</li>
						</ul>
					</td>
				</tr>	
				@endforeach
			</tbody>
		</table>
	</section>
	{!! $playlists->appends(request()->input())->render() !!}	
@stop