<x-app-layout>
	<x-slot name="title">Labels</x-slot>
	
	<x-page-header>Labels</x-page-header>
	
	<section id="label-list-gird">
	@foreach ($labels as $label) 
		<article>
			<a href="{{ route('labels.tracks.index', $label->slug) }}" title="View {{ $label->label }} tracks">			
				<img src="{{ asset($label->getLabelImage()) }}" alt="{{$label->label}}">
			</a>
			<footer>
				<a href="{{ route('labels.tracks.index', $label->slug) }}" title="View {{ $label->label }} tracks">			
					{{ $label->label }}
				</a>
			</footer>
		</article>
	@endforeach
	</section>

	<x-pagination :model="$labels" />
	
</x-app-layout>