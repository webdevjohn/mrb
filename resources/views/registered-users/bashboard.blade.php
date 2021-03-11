@extends('master-layout')
@section('title', 'My Record Box - Dashboard')
@section('page-header', 'Dashboard')
@section('content')

	<div class="wrapper">

		<section id="dashboard-options">
			<ul>
				<li>
					<a href="{{ route('dashboard.favourite-tracks')}}" class="btn-favourite-tracks">View Favourite Tracks</a>
				</li>
			</ul>
		</section>

	</div>

@stop