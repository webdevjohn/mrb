<x-app-layout>
	<x-slot name="title">{{ $playlist->name }}</x-slot>

	<x-page-header>{{ $playlist->name }}</x-page-header>

	<x-track-listings :tracks="$tracks" /> 				
		 
	<x-pagination :model="$tracks" />
</x-app-layout>