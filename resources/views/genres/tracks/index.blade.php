<x-app-layout>
	<x-slot name="title">{{ $genre->genre }}</x-slot>
 
 	<h1 id="page-header">
		<div class="wrapper">
	 		{{ $genre->genre }} <span onclick="openNav()">&#9776; Filters</span>
		</div>
	</h1>

	<div class="wrapper">
		<section id="sortable-fields">
			<ul>
				<li>
					<span>Year Released</span>
					<a href="{{ request()->fullUrlWithQuery(['field' => 'year_released', 'order' => 'desc']) }}" title="Sort Year Released 9-0">Desc</a>
					<a href="{{ request()->fullUrlWithQuery(['field' => 'year_released', 'order' => 'asc']) }}" title="Sort Year Released 0-9">Asc</a>
				</li>
				<li>
					<span>Popularity</span>
					<a href="{{ request()->fullUrlWithQuery(['field' => 'popularity', 'order' => 'desc'])}}" title="Sort Popularity 9-0">Desc</a>
					<a href="{{ request()->fullUrlWithQuery(['field' => 'popularity', 'order' => 'asc'])}}" title="Sort Popularity 0-9">Asc</a>
				</li>
			</ul>								
		</section>
		<section class="track-listings">
			@include('_partials.tracks', ['tracks' => $genreTracks])				
		</section> 
 	</div>

	<section>
		<div class="wrapper">
			{!! $genreTracks->appends(request()->input())->render() !!}	
		</div>
	</section>


	<div id="myNav" class="modal-overlay">

  		<!-- Button to close the overlay navigation -->
  		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

		<section id="filters-overlay" class="wrapper">		
			<form>
				<h1>Record Labels</h1>
				<ul class="filter-group">
				@foreach ($labels as $label)
					<li>
						<input  name="labels[]" type="checkbox" value="{{ $label->id }}" id="{{ $label->id }}">
						<label for="{{ $label->id }}">{{ $label->label }}</label>
					</li>				
				@endforeach
				</ul>

				<h1>Artists</h1>
				<ul class="filter-group">
				@foreach ($artists as $artist)
					<li>
						<input  name="artists[]" type="checkbox" value="{{ $artist->id }}" id="{{ $artist->id }}">
						<label for="{{ $artist->id }}">{{ $artist->artist_name }}</label>
					</li>				
				@endforeach
				</ul>

				<button type="submit">Apply Filters</button>
			</form>
		</section>
	</div>

	<script>
		function openNav() {
			document.getElementById("myNav").style.height = "100%";
		}

		function closeNav() {
			document.getElementById("myNav").style.height = "0%";
		}
	</script>
</x-app-layout>