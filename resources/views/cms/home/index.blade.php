@extends('cms-layout')
@section('title', 'Home Page')

@section('breadcrums')	
	<li><a href="{{ route('cms.homepage') }}">Home</a></li>
@stop

@section('content')
	<section class="widget-list">	
		<article>
			<div class="icon icon-track"></div>
			<h1>Tracks</h1>
			<p>{{ $trackCount }}</p>		
		</article>

		<article>
			<div class="icon icon-artist"></div>
			<h1>Artists</h1>
			<p>{{ $artistCount }}</p>			
		</article>
	
		<article>
			<div class="icon icon-record-label"></div>
			<h1>Record Labels</h1>
			<p>{{ $labelCount }}</p>		
		</article>

		<article>
			<div class="icon icon-album"></div>
			<h1>Albums</h1>
			<p>{{ $albumCount }}</p>		
		</article>		
	</section>

	<section class="chart-list">
		<article>
			<canvas id="chartTracksPurchasedThisYear"></canvas>
		</article>
		<article>	
			<canvas id="chartTracksPurchasedLastYear"></canvas>
		</article>
	</section>

	<section class="feature-list">
		<article>
			<div class="icon icon-database"><h1>Manage Base Database</h1></div>
			<ul>
				<li><a href="{!! route('cms.albums.index') !!}">Albums</a></li>
				<li><a href="{{ route('cms.artists.index') }}">Artists</a></li>
				<li><a href="{!! route('cms.formats.index') !!}">Formats</a></li>
				<li><a href="{!! route('cms.genres.index') !!}">Genres</a></li>
				<li><a href="{{ route('cms.labels.index') }}">Labels</a></li>
				<li><a href="{{ route('cms.playlists.index') }}">Playlists</a></li>
				<li><a href="{{ route('cms.tags.index') }}">Tags</a></li>
				<li><a href="{{ route('cms.tracks.index') }}">Tracks</a></li>				
			</ul>
		</article>

		<article>
			<div class="icon icon-tools"><h1>Tools</h1></div>
			<ul>
				<li></li>
			</ul>
		</article>

		<article>
			<div class="icon icon-reports"><h1>Reports</h1></div>
			<ul>
				<li></li>
			</ul>
		</article>
</section>


	@section('javascript')	
		<script type="text/javascript">
			
			Chart.defaults.global.elements.point.borderWidth = 2;
			Chart.defaults.global.elements.point.hitRadius = 5;
	
			$.ajax({
	            url: '{{ URL::route('cms.tracks.by-year-purchased', date("Y")) }}',
	            type: 'GET',
	            success: function(results)
	            {
	            	var labels = [], data = [];
	            	var ctx = document.getElementById("chartTracksPurchasedThisYear");
					var chartTitle = 'Tracks Purchased This Year ({{ date("Y")}})';
			  		
			  		for (var key in results) 
					{
					    let value = results[key];					
					    labels.push(value.month);
					    data.push(value.track_count);
					}
		
					var chartData = {
					        labels: labels,
					        datasets: [{					
					            fill: false,				
      							backgroundColor: 'rgb(28, 128, 165)',
      							borderColor: 'rgb(28, 128, 165)',
					            data: data,					        
					        }]
					    };

					var myChart = createLineChart(ctx, chartData, chartTitle);
				
	        	}
        	});


        	$.ajax({
	            url: '{{ URL::route('cms.tracks.by-year-purchased', $theDate = date("Y") -1) }}',
	            type: 'GET',
	            success: function(results)
	            {
					var labels = [], data = [];
					var ctx = document.getElementById("chartTracksPurchasedLastYear");
					var chartTitle = 'Tracks Purchased Last Year ({{ $theDate = date("Y") -1 }})';
			  		
			  		for (var key in results) 
					{
					    let value = results[key];					
					    labels.push(value.month);
					    data.push(value.track_count);
					}
					
					var chartData = {
					        labels: labels,
					        datasets: [{
					            fill: false,
					        	backgroundColor: 'rgb(28, 128, 165)',
      							borderColor: 'rgb(28, 128, 165)',
					            data: data,					        
					        }]
					    };

					var myChart = createLineChart(ctx, chartData, chartTitle);
	        	}
        	});


        	function createLineChart(ctx, data, chartTitle)
        	{      		
				return myLineChart = new Chart(ctx, {
		            type: 'line',
		            data: data,
		            options: {				 					   
				    	legend: {
			           	 	display: false,				         
			        	},
			        	title: {
	    					display: true,
	    					text: chartTitle
						},
				        scales: {
				            yAxes: [{
				                ticks: {
				                    beginAtZero:true
				                }
				            }]
				        }
					},		       
		        });
        	}


		</script>
	@stop

@stop