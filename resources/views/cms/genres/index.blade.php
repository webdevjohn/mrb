@extends('cms-layout')
@section('title', 'Genres')

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li class="last">Genres</li>
@stop

@section('content')

	<section class="table-con">

		<a href="{{ route('cms.genres.create') }}" class="btn btn-new-record float-right" title="New Record">New Record +</a>
		
		<h1 class="section-header">Genres</h1>

		<table>
			<thead>
				<tr>
					<th class="table-col-genres-genre">Genre</th>				
					<th>Actions</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="2"><a href="{{ route('cms.genres.create') }}">Create a New Genre</a></td>
				</tr>
			</tfoot>
			<tbody>
				@foreach($genres as $genre)
				<tr>
					<td>{{ $genre->genre }}</td>				
					<td>
						<ul class="frm-crud-buttons">
							<li>
								<a href="{{ route('cms.genres.edit', $genre->slug) }}" class="btn btn-edit-record" title="Edit Record">Edit</a>
							</li>
						</ul>
					</td>
				</tr>	
				@endforeach
			</tbody>
		</table>
	</section>
	{!! $genres->appends(request()->input())->render() !!}	
@stop