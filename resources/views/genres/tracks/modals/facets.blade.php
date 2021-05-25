<div id="modal">
	<article>
		<header class="{{ $genre->slug }}-bg">
			<h1>{{ $trackCount }} <span>{{ $genre->genre }}</span> Tracks</h1>
			<a href="javascript:void(0)" class="closebtn" onclick="closeModal()" title="Close modal">&times;</a>
		</header>
		
		<div class="content">
			<div class="icon-bar">
				<a href="javascript:void(0)" class="tablink active-tab" onclick="openTab(event,'tab-artists')">Artists</a>
				<a href="javascript:void(0)" class="tablink" onclick="openTab(event,'tab-record-labels')">Record Labels</a>			
				<a href="javascript:void(0)" class="tablink" onclick="openTab(event,'tab-years-of-release')">Years of Release</a>
			</div>

			<form id="filter-tracks">
				<section id="tab-artists" class="tab">
					<input type="text" id="artistSearchInput" onkeyup="searchList('artistSearchInput', 'searchArtists')" placeholder="Search artists.." title="Type in an artist name.">	
					<ul class="filter-group" id="searchArtists">
					@foreach ($artists as $artist)
						<li>									
							<input {{ Str::isCheckBoxSelected(request()->artists, "artist-". $artist->id) }} 
								name="artists[]" 
								type="checkbox" 
								value="artist-{{ $artist->id }}" 
								id="artist-{{ $artist->id }}">
							<label for="artist-{{ $artist->id }}">{{ $artist->artist_name }}</label>
						</li>				
					@endforeach
					</ul>
				</section>

				<section id="tab-record-labels" class="tab" style="display:none">	
					<input type="text" id="labelsSearchInput" onkeyup="searchList('labelsSearchInput', 'searchLabels')" placeholder="Search record labels.." title="Type in a record label name.">	
					<ul class="filter-group" id="searchLabels">
					@foreach ($labels as $label)
						<li>
							<input {{ Str::isCheckBoxSelected(request()->labels, "label-". $label->id) }} 
								name="labels[]" 
								type="checkbox" 
								value="label-{{ $label->id }}" 
								id="label-{{ $label->id }}">
							<label for="label-{{ $label->id }}">{{ $label->label }}</label>
						</li>				
					@endforeach
					</ul>
				</section>

				<section id="tab-years-of-release" class="tab" style="display:none">
					<input type="text" id="yearsReleasedSearchInput" onkeyup="searchList('yearsReleasedSearchInput', 'searchYearsReleased')" placeholder="Search years released.." title="Type in a year of release.">	
					<ul class="filter-group" id="searchYearsReleased">
					@foreach ($releaseYears as $releaseYear)
						<li>
							<input {{ Str::isCheckBoxSelected(request()->years_released, $releaseYear->year_released) }} 
								name="years_released[]" 
								type="checkbox" 
								value="{{ $releaseYear->year_released }}" 
								id="{{ $releaseYear->year_released }}">
							<label for="{{ $releaseYear->year_released }}">{{ $releaseYear->year_released }}</label>
						</li>				
					@endforeach
					</ul>
				</section>						
			</form>			
		</div>
		
		<footer>
			<a href="javascript:{}" onclick="document.getElementById('filter-tracks').submit();" 
				class="{{ $genre->slug }}-bg" title="Apply filters">Apply Filters</a>
		</footer>	
	</article>	
</div>

<script>	
	function searchList(input, listToSearch) {
		var input, filter, ul, li, a, i, txtValue;
		input = document.getElementById(input);
		filter = input.value.toUpperCase();
		ul = document.getElementById(listToSearch);
		li = ul.getElementsByTagName("li");
		for (i = 0; i < li.length; i++) {
			a = li[i].getElementsByTagName("label")[0];
			txtValue = a.textContent || a.innerText;
			if (txtValue.toUpperCase().indexOf(filter) > -1) {
				li[i].style.display = "";
			} else {
				li[i].style.display = "none";
			}
		}
	}

	function openTab(evt, tabName) {
		var i, x, tablinks;

		x = document.getElementsByClassName("tab");

		for (i = 0; i < x.length; i++) {
			x[i].style.display = "none";
		}
		
		tablinks = document.getElementsByClassName("tablink");

		for (i = 0; i < x.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active-tab", "");
		}

		document.getElementById(tabName).style.display = "block";
		
		evt.currentTarget.className += " active-tab";
	}

	function closeModal() {
		document.getElementById("modal").style.display = "none";
	}
</script>