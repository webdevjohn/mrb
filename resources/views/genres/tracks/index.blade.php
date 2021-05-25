<x-app-layout>
	<x-slot name="title">{{ $genre->genre }}</x-slot>
	
 	<x-page-header>{{ $genre->genre }} <span onclick="loadFacets()">&#9776; Filters</span></x-page-header>

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

	<x-track-listings :tracks="$tracks" /> 

	<x-pagination :model="$tracks" />

	<div id="modal-con"></div>

	<div id="loader" class="lds-dual-ring hidden page-overlay"></div>

	<x-slot name="javascript">
		<script>
			function loadFacets() {
				$.ajax({
					type: "GET",
					url: window.location.href,
				beforeSend: function() {
					$('#loader').removeClass('hidden')
				},
				}).done(function(modalData) {   
					$('#loader').addClass('hidden')
					$("#modal-con").html(modalData);
					document.getElementById("modal").style.display = "block";	
				});    

				return false;	
			};			
		</script>
	</x-slot>
</x-app-layout>