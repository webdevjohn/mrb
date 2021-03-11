@extends('cms-layout')
@section('title', 'Tracks with no Keycode')
@section('page-header','Tracks with no Keycode')
@section('content')
	<table>
		<thead>
			<tr>
				<th>Artists</th>
				<th>Title</th>
				<th>Keycode</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="3"><a href=""></a></td>
			</tr>
		</tfoot>
		<tbody>

			{{ Form::open(['route' => 'cms.reports.tracks_with_no_keycode.update']) }}

			@foreach($tracks as $track)
			<tr>
				@include('_partials.reporting_artist_title')
				<td> 						
					{{ Form::select('key_code_id[' . $track->id . ']', $keycodesList) }}
				</td>
			</tr>	
			@endforeach

		</tbody>
	</table>

			{{ Form::button('Submit', array('type' => 'submit')) }}
			{{ Form::close() }}

	{{ $tracks->links() }}
@stop