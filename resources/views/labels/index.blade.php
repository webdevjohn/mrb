<x-app-layout>
	<x-slot name="title">Labels</x-slot>
	
	<x-page-header>Labels</x-page-header>
	
	<div class="wrapper">
		<section id="label-list-gird">
		@foreach ($labels as $label) 
			@include('_partials.labels')
		@endforeach
		</section>
	</div>
	
	<x-pagination :model="$labels" />
	
</x-app-layout>