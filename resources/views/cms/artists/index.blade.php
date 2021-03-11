@extends('cms-layout')
@section('title', 'Artists')

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li>&gt;</li>
	<li class="active-breadcrum">{{ $page }}</li>
@stop

@section('content')
	
	<section class="table-con">

		<a href="{{ route('cms.artists.create') }}" class="btn btn-new-record float-right" title="New Record">New Record +</a>

		<h1 class="section-header">Artists</h1>

		<table>
			<thead>
				<tr>
					<th class="table-col-artists-artist">Artist</th>					
					<th>Actions</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="2"><a href="{{ route('cms.artists.create') }}">Create a New Artist</a></td>
				</tr>
			</tfoot>
			<tbody>
				@foreach($artists as $artist)
				<tr>
					<td>{{ $artist->artist_name }}</td>				
					<td>						
						<ul class="frm-crud-buttons">
							<li>
								<a href="{{ route('cms.artists.edit', $artist->id) }}" class="btn btn-edit-record" title="Edit Record">Edit</a>
							</li>
						</ul>
					</td>
				</tr>	
				@endforeach
			</tbody>
		</table>
	</section>
	{!! $artists->appends(request()->input())->render() !!}	
@stop