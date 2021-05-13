<x-app-layout>
    <x-slot name="title">{{ $album->title }}</x-slot>	 
	         
	<x-page-header>{{ $album->title }}</x-page-header>
	
	<x-track-listings :tracks="$tracks" /> 
</x-app-layout>