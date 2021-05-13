<x-app-layout>
	<x-slot name="title">Labels</x-slot>
	
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
	
	<section>
		<div class="wrapper">
			{!! $labels->appends(request()->input())->render() !!}	
		</div>
	</section>
	
</x-app-layout>