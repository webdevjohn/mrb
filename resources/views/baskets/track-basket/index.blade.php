<x-app-layout>
	<x-slot name="title">Basket</x-slot>

	<x-page-header>Basket</x-page-header>

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
</x-app-layout>