<x-app-layout>
	<x-slot name="title">{{ $label->label }}</x-slot>

	<x-page-header>{{ $label->label }}</x-page-header>

	<x-track-listings :tracks="$tracks" /> 		
	
	<x-pagination :model="$tracks" />	
</x-app-layout>