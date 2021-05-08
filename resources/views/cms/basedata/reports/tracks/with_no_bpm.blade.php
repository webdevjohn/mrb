@extends('cms-layout')
@section('title', 'Tracks with no BPM')
@section('page-header','Tracks with no BPM')
@section('content')
	<table>
		<thead>
			<tr>
				<th>Artists</th>
				<th>Title</th>
				<th>BPM</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="3"><a href=""></a></td>
			</tr>
		</tfoot>
		<tbody>

			{{ Form::open(['route' => 'cms.reports.tracks_with_no_bpm.update']) }}

			@foreach($tracks as $track)
			<tr>
				@include('_partials.reporting_artist_title')
				<td> 
					<input type="text" name="bpm[{{$track->id}}]" class="input-field-bpm"/>			
				</td>
			</tr>	
			@endforeach

		</tbody>
	</table>

			{{ Form::button('Submit', array('type' => 'submit')) }}
			{{ Form::close() }}

	{{ $tracks->links() }}
@stop