<section id="menu-con">
	<h1 class="menu-header base-data">Base Data</h1>
	<nav>
		<ul>
			<li><a href="{!! URL::route('cms.albums.index') !!}" class="{{ $page == 'Albums' ? 'active' : 'inactive' }}">Albums</a></li>
			<li><a href="{!! URL::route('cms.artists.index') !!}" class="{{ $page == 'Artists' ? 'active' : 'inactive' }}">Artists</a></li>
			<li><a href="{!! URL::route('cms.formats.index') !!}" class="{{ $page == 'Formats' ? 'active' : 'inactive' }}">Formats</a></li>
			<li><a href="{!! URL::route('cms.genres.index') !!}" class="{{ $page == 'Genres' ? 'active' : 'inactive' }}">Genres</a></li>
			<li><a href="{!! URL::route('cms.labels.index') !!}" class="{{ $page == 'Labels' ? 'active' : 'inactive' }}">Labels</a></li>
			<li><a href="{!! URL::route('cms.tags.index') !!}" class="{{ $page == 'Tags' ? 'active' : 'inactive' }}">Tags</a></li>
			<li><a href="{!! URL::route('cms.tracks.index') !!}" class="{{ $page == 'Tracks' ? 'active' : 'inactive' }}">Tracks</a></li>			
		</ul>
	</nav>

	<h1 class="menu-header reporting">Reporting</h1>
	<nav>
		<ul>
			<li><a href="">Tracks with no MP3 sample</a></li>
		</ul>
	</nav>

	<h1 class="menu-header user-management">User Management</h1>
	<nav>
		<ul>
			<li><a href="">Users</a></li>
		</ul>
	</nav>
</section>