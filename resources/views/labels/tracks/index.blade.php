@extends('master-layout')
@section('title', 'My Record Box -' . $label->label)
@section('content')

	<h1 id="page-header">
		<div class="wrapper">{{ $label->label }}</div>
	</h1>

	<div class="wrapper">
		<section class="track-listings">
			@include('_partials.tracks', ['tracks' => $tracks])
		</section> 					
 	</div>

	<section>
		{!! $tracks->appends(request()->input())->render() !!}	
	</section>
	
@stop