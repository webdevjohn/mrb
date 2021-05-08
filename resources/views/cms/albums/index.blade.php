@extends('cms-layout')
@section('title', 'Albums')

@section('page-header')
	<h1>
		Albums
		<a href="{{ route('cms.albums.create') }}" 
			class="btn btn-new-record float-right" 
			title="New Album">New Album +</a> 
	</h1>
@stop

@section('breadcrums')	
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li>Albums</li>	
@stop

@section('content')

	<section class="table-con">
		<table>
			<thead>
				<tr>
					<th class="table-col-albums-title">Title</th>			
					<th class="table-col-albums-year-released">Year Released</th>	
					<th class="table-col-albums-purchase-date">Purchase Date</th>	
					<th class="table-col-albums-purchase-price">Purchase Price</th>						
					<th>Actions</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="5"><a href="{{ route('cms.albums.create') }}">Create a New Album</a></td>
				</tr>
			</tfoot>
			<tbody>
				@foreach($albums as $album)
				<tr>
					<td>{{ $album->title }}</td>		
					<td>{{ $album->year_released }}</td>		
					<td>{{ $album->purchase_date }}</td>
					<td>&pound;{{ $album->purchase_price }}</td>
					<td>
						<ul class="frm-crud-buttons">
							<li>
								<a href="{{ route('cms.albums.tracks.index', $album->slug) }}" class="btn btn-view-record" title="View Record">View Tracks</a>								
							</li>
							<li>
								<a href="{{ route('cms.albums.edit', $album->slug) }}" class="btn btn-edit-record" title="Edit Record">Edit</a>
							</li>
						</ul>
					</td>
				</tr>	
				@endforeach
			</tbody>
		</table>
	</section>
	{!! $albums->appends(request()->input())->render() !!}	
@stop