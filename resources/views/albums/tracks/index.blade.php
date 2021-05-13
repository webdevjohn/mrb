<x-app-layout>
    <x-slot name="title">{{ $album->title }}</x-slot>
	           
	<x-page-header>{{ $album->title }}</x-page-header>

	<div class="wrapper">
		<x-track-listings :tracks="$tracks" /> 
	</div>

</x-app-layout>