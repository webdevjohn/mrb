@extends('cms-layout')
@section('title', 'Tracks with no MP3 Sample')
@section('page-header','Tracks with no MP3 Sample')
@section('content')
	<table>
		<thead>
			<tr>
				<th>Artists</th>
				<th>Title</th>
				<th>MP3 Sample</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="3"><a href=""></a></td>
			</tr>
		</tfoot>
		<tbody>

			{{ Form::open(['route' => 'cms.reports.tracks_no_mp3_sample.update']) }}

			@foreach($tracks as $track)
			<tr>
				@include('_partials.reporting_artist_title')
				<td> <input type="text" name="mp3_sample_filename[{{$track->id}}]" class="input-field-filename" /></td>
			</tr>	
			@endforeach

		</tbody>
	</table>

			{{ Form::button('Submit', array('type' => 'submit')) }}
			{{ Form::close() }}

	{{ $tracks->links() }}
@stop