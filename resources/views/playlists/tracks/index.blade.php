<x-app-layout>
	<x-slot name="title">{{ $playlist->name }}</x-slot>

	<x-page-header>{{ $playlist->name }}</x-page-header>

	<div class="wrapper">
		<x-track-listings :tracks="$tracks" /> 				
	</div>			
	 
	<x-pagination :model="$tracks" />
	
</x-app-layout>