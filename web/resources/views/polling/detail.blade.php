@extends('layouts.chart')

@section('content')
<div class="container">
	<br>
	<h3 class="text-center" style="color:#000000;font-weight: bold;">{{$polling->id==3?"IDOL TERFAVORIT":$polling_question->content}}</h3>
	<hr>
	<canvas id="myChart"></canvas>


</div>
@endsection

@section('footer')
<!-- <script type="text/javascript" src="{{url('')}}:9000/socket.io/socket.io.js"></script> -->
<script type="text/javascript">
/*	var socket = io("{{url('')}}:9000");

	socket.on('screen.change',function(msg) {
		$("body").fadeOut(500);
		setTimeout(function () {
			window.location = msg
		},500);
	});*/
	var bgColor = [
	'rgba(255, 99, 132, 0.7)',
	'rgba(54, 162, 235, 0.7)',
	'rgba(255, 206, 86, 0.7)',
	'rgba(75, 192, 192, 0.7)',
	'rgba(153, 102, 255, 0.7)',
	'rgba(255, 159, 64, 0.7)'
	],
	bdColor = [
	'rgba(255, 99, 132, 1)',
	'rgba(54, 162, 235, 1)',
	'rgba(255, 206, 86, 1)',
	'rgba(75, 192, 192, 1)',
	'rgba(153, 102, 255, 1)',
	'rgba(255, 159, 64, 1)'
	];
	var ctx = document.getElementById('myChart');
	
	<?php $i=0; ?>

	var data = {
		labels:[
		@foreach($polling_response as $row)
		'{{$row->polling_answer->content}}',
		@endforeach
		],
		datasets: [
		{
			data: [ 
			@foreach($polling_response as $row)
			'{{$row->total}}',
			@endforeach
			],
			backgroundColor:[
			@foreach($polling_response as $row)
			bgColor[{{$i++}}],
			@endforeach
			],
			<?php $i=0; ?>
			backgroundColor:[
			@foreach($polling_response as $row)
			bdColor[{{$i++}}],
			@endforeach
			],
			borderWidth: 1
		},


		]
	};

	var myChart = new Chart(ctx, {
		type: 'bar',
		data: data,
		options: {
			"hover": {
				"animationDuration": 0
			},
			"animation": {
				"duration": 1,
				"onComplete": function() {
					var chartInstance = this.chart,
					ctx = chartInstance.ctx;

					ctx.font = Chart.helpers.fontString(25, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
					ctx.textAlign = 'center';
					ctx.textBaseline = 'bottom';

					this.data.datasets.forEach(function(dataset, i) {
						var meta = chartInstance.controller.getDatasetMeta(i);
						meta.data.forEach(function(bar, index) {
							var data = dataset.data[index];
							ctx.fillText(data, bar._model.x, bar._model.y - 5);
						});
					});
				}
			},
			legend: {
				"display": false
			},
			tooltips: {
				"enabled": false
			},
			scales: {
				yAxes: [{
					display: false,
					gridLines: {
						display: false
					},
					ticks: {
						max: Math.max(...data.datasets[0].data) + 10,
						display: false,
						beginAtZero: true
					}
				}],
				xAxes: [{
					gridLines: {
						display: false
					},
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}

	});

</script>
@endsection