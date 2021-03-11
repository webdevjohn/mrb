@extends('master-layout')
@section('title', 'My Record Box - Basket')
@section('page-header', 'Basket')
@section('content')

	<h1 id="page-header">
		<div class="wrapper">Basket</div>
	</h1>

{{-- <section id="basket-options">
		<ul>					
			<li>
				<a href="{{ route('track-basket.add-to-user-favourites')}}" class="add-to-favourites">Add to Favourites</a>
			</li>
			<li>
				<a href="{{ route('track-basket.destroy')}}" class="empty-basket">Empty Basket</a>					
			</li>
		</ul>
	</section> --}}

	@if($items)
		<div class="wrapper">
			<section class="track-listings">	
				@include('_partials.tracks', ['tracks' => $items])					
			</section> 			
		</div>
	@endif
@stop