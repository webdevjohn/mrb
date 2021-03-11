@extends('master-layout')
@section('title', 'My Record Box - Labels')
@section('content')
	
	<h1 id="page-header">
		<div class="wrapper">Labels</div>
	</h1>
	
	<div class="wrapper">
		<section id="label-list-gird">
		@foreach ($labels as $label) 
			@include('_partials.labels')
		@endforeach
		</section>
	</div>
	
	{!! $labels->links() !!}  
	
@stop