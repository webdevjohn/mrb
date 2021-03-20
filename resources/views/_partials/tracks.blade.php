@foreach($tracks as $track)
<article class="{{ $track->genre->slug }}">		
	<img src="{{ asset($track->getTrackThumbnail()) }}" alt="{{ $track->title }}">
	<div class="overlay">
		<div class="sm2-inline-list">
			<div class="ui360 ui360-vis btn-play-track" data-track-id="{{ route('tracks.played', $track->id) }}" data-playing="false">		
				<a href="{{ asset($track->getTrackMp3Sample())}}" title="Play Track"></a>
			</div>
		</div>
	</div>
	<section class="track-details-con">
		<ul class="artist-list">
			@foreach ($track->artists as $artist)
			<li><a href="{{ route('artists.tracks.index', $artist->slug) }}">{{ $artist->artist_name }}</a></li>						
			@endforeach
		</ul>
		<h1>{{ $track->title }}</h1>
		<h2><a href="{{ route('labels.tracks.index', $track->label->slug)  }}">{{ $track->label->label }}</a></h2>
		<h3>{{ $track->year_released }}</h3>
	</section>
	<footer>
		<ul>	
			<li>						
			@if($trackBasket->hasItem($track->id))
				<a href="{{ route('basket.store', $track->id) }}" title="Add track to record box" 
					class="btn-add-track track-added">In Basket</a>	
			@else
				<a href="{{ route('basket.store', $track->id) }}" title="Add track to record box" 
					class="btn-add-track">Add</a>	
			@endif
			</li>	
			<li><a href="{{ route('tracks.show', $track->id) }}" title="View track details">View</a></li>
		</ul>
	</footer>
</article>
@endforeach	