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