<x-app-layout>
	<x-slot name="title">{{ $label->label }}</x-slot>

	<x-page-header>{{ $label->label }}</x-page-header>

	<div class="wrapper"> 			
		<x-track-listings :tracks="$tracks" /> 		
 	</div>

	<x-pagination :model="$tracks" />
	
</x-app-layout>