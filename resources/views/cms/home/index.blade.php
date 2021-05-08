@extends('cms-layout')
@section('title', 'Home Page')

@section('page-header')
	<h1>Dashboard</h1>
@stop

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

	<section id="main-chart">
		<article>
			<canvas id="chartTracksByYear" height="100"></canvas>
		</article>
	</section>
	
	<section id="yearly-track-totals">
		<section id="track-totals-this-year">		
			<article>
				<h1>{{ $totalsThisYear->yearly_count }}</h1>
				<h2>Tracks Purchased This Year</h2>
			</article>
			<article>
				<h1>£{{ $totalsThisYear->yearly_cost }}</h1>
				<h2>Cost This Year</h2>
			</article>
		</section>
		<section id="track-totals-last-year">
			<article>
				<h1>{{ $totalsLastYear->yearly_count }}</h1>
				<h2>Tracks Purchased Last Year</h2>
			</article>
			<article>
				<h1>£{{ $totalsLastYear->yearly_cost }}</h1>
				<h2>Cost Last Year</h2>
			</article>
		</section>
	</section>

	<section id="chart-list">
		<article>
			<canvas id="chartTracksPurchasedThisYear"></canvas>
		</article>
		<article>	
			<canvas id="chartTracksPurchasedLastYear"></canvas>
		</article>
	</section>

	<section class="pie-charts"> 
		<article>		
			<canvas id="genreSummaryThisYear"></canvas>
		</article>
		<article>
			<canvas id="genreSummaryLastYear"></canvas>
		</article>
	</section>


	@section('javascript')	
		<script type="text/javascript">
	
			Chart.defaults.global.elements.point.borderWidth = 2;
			Chart.defaults.global.elements.point.hitRadius = 5;
	
			$.ajax({
	            url: '{{ route('cms.tracks.by-year-purchased', date("Y")) }}',
	            type: 'GET',
	            success: function(results)
	            {			
	            	var labels = [], data = [];
	            	var ctx = document.getElementById("chartTracksPurchasedThisYear");
					var chartTitle = 'Tracks Purchased This Year ({{ date("Y")}})';
			  		
			  		for (var key in results) {
					    let value = results[key];					
					    labels.push(value.month);
					    data.push(value.track_count);
					}
		
					var chartData = {
					        labels: labels,
					        datasets: [{					
					            fill: true,				
      							backgroundColor: '#FD8B05',
      							borderColor: '#FD8B05',
					            data: data,					        
					        }]
					    };

					var myChart = createLineChart(ctx, chartData, chartTitle);
				
	        	}
        	});

        	$.ajax({
	            url: '{{ route('cms.tracks.by-year-purchased', date("Y") -1) }}',
	            type: 'GET',
	            success: function(results)
	            {
					var labels = [], data = [];
					var ctx = document.getElementById("chartTracksPurchasedLastYear");
					var chartTitle = 'Tracks Purchased Last Year ({{ $theDate = date("Y") -1 }})';
			  		
			  		for (var key in results) {
					    let value = results[key];					
					    labels.push(value.month);
					    data.push(value.track_count);
					}
					
					var chartData = {
					        labels: labels,
					        datasets: [{
					            fill: true,
					        	backgroundColor: '#FD8B05',
      							borderColor: '#FD8B05',
					            data: data,					        
					        }]
					    };

					var myChart = createLineChart(ctx, chartData, chartTitle);			
	        	}
        	});

    		$.ajax({
	            url: '{{ route('cms.tracks.by-year') }}',
	            type: 'GET',
	            success: function(results)
	            {
					var labels = [], data = [];
					var ctx = document.getElementById("chartTracksByYear");
					var chartTitle = 'Tracks Purchased by Year';
			  		
			  		for (var key in results) {
					    let value = results[key];					
					    labels.push(value.year);
					    data.push(value.track_count);
					}
					
					var chartData = {
					        labels: labels,
					        datasets: [{
					            fill: true,
					        	backgroundColor: '#FD8B05',
      							borderColor: '#FD8B05',
					            data: data,					        
					        }]
					    };

					var myChart = createLineChart(ctx, chartData, chartTitle);			
	        	}
        	});


        	$.ajax({
	            url: '{{ route('cms.genres.summary', date("Y")) }}',
	            type: 'GET',
	            success: function(results)
	            {
					var labels = [], data = [], bgColours = [];
					var ctx = document.getElementById("genreSummaryThisYear");
					var chartTitle = 'Tracks Purchased by Genre ({{ date("Y") }})';
			  		
			  		for (var key in results) {
					    let value = results[key];					
					    labels.push(value.genre + " (" + value.track_count + ")");
					    data.push(value.track_count);
						bgColours.push(value.colour_code);
					}
					
					var chartData = {
					        labels: labels,
					        datasets: [{
					            fill: true,
					        	backgroundColor: bgColours,      					
					            data: data,					        
					        }]
					    };

					var myChart = createPieChart(ctx, chartData, chartTitle);			
	        	}
        	});

			$.ajax({
	            url: '{{ route('cms.genres.summary', date("Y")-1) }}',
	            type: 'GET',
	            success: function(results)
	            {
					var labels = [], data = [], bgColours = [];
					var ctx = document.getElementById("genreSummaryLastYear");
					var chartTitle = 'Tracks Purchased by Genre ({{ date("Y")-1 }})';
			  		
			  		for (var key in results) {
					    let value = results[key];					
					    labels.push(value.genre + " (" + value.track_count + ")");
					    data.push(value.track_count);
						bgColours.push(value.colour_code);
					}
					
					var chartData = {
					        labels: labels,
					        datasets: [{
					            fill: true,
					        	backgroundColor: bgColours,      					
					            data: data,					        
					        }]
					    };

					var myChart = createPieChart(ctx, chartData, chartTitle);			
	        	}
        	});

		

			function createPieChart(ctx, chartData, chartTitle)
			{
				new Chart(ctx, {
					type: 'pie',
					data: chartData,
					options: {
						responsive: true,
						legend: {
			           	 	display: true,	
								position: "bottom",
							labels: {
                    			fontColor: '#DCDCDC',	                
								fontSize: 12
                			}									         
			        	},
						title: {
							display: true,
							text: chartTitle,
							fontColor: '#DCDCDC',
							fontSize: 16,
						}
					}
				});
			}


        	function createLineChart(ctx, data, chartTitle)
        	{      		
				return myLineChart = new Chart(ctx, {
		            type: 'line',
		            data: data,
		            options: {	
						responsive: true,			 					   
				    	legend: {
			           	 	display: false,				         
			        	},

			        	title: {
	    					display: true,
	    					text: chartTitle,
							fontColor: '#DCDCDC',
							fontSize: 16,
						},

				        scales: {
				            yAxes: [{
								gridLines: { 
									zeroLineColor: '#212024',
									color: "#212024", 
								},
				                ticks: {
									fontColor: "#DCDCDC",									                         
				                    beginAtZero:true
				                },
				            }],
							xAxes: [{
				                ticks: {
									fontColor: "#DCDCDC",									                         
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
