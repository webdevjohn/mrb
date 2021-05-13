<x-cms-registerd-layout>
	<x-slot name="title">Dashboard</x-slot>

	<div class="wrapper">
		<section id="dashboard-options">
			<ul>
				<li>
					<a href="{{ route('dashboard.favourite-tracks')}}" class="btn-favourite-tracks">View Favourite Tracks</a>
				</li>
			</ul>
		</section>
	</div>

</x-cms-registerd-layout>