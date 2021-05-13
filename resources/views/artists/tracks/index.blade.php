<x-app-layout>
	<x-slot name="title">{{ $artist->artist_name }}</x-slot>

	<x-page-header>{{ $artist->artist_name }}</x-page-header>

	<x-track-listings :tracks="$tracks" /> 
	
	<x-pagination :model="$tracks" />
</x-app-layout>