@extends('cms-layout')
@section('title', 'Base Data')

@section('page-header')
	<h1>Base Data</h1>	
@stop

@section('breadcrums')
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
	<li>Base Data</li>
@stop

@section('content')

	@php
		$models = ['albums', 'artists', 'formats', 'genres', 'labels', 'playlists', 'tags', 'tracks'];
	@endphp

	<section class="table-con basedata">
		<table>
			<thead>
				<tr>
					<th class="table-col-model">Model</th>				
					<th># Records</th>						
					<th>Actions</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="3"></td>
				</tr>
			</tfoot>
			<tbody>	
				@foreach ($models as $model)							
				<tr>		
					<td>{{ $model }}</td>	
					<td>{{ $recordCount->$model }}</td>
					<td>
						<ul class="frm-crud-buttons">			
							<li>
								<a href="{{ route("cms.basedata.$model.index") }}" class="btn btn-view-record">View</a>
							</li>
							<li>
								<a href="{{ route("cms.basedata.$model.create") }}" class="btn btn-new-record">New +</a>
							</li>
						</ul>
					</td>
				</tr>	
				@endforeach				
			</tbody>
		</table>
	</section>
@stop