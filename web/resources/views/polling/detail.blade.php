@extends('layouts.chart')

@section('content')
<div style="overflow:hidden;background-color: #2d89ef;">
	
	<div class="container" style="width: 1920px;height: 1080px;margin:0 auto;">
		<h3 class="text-center" style="font-size:30pt;margin-top:10%;color:#ffffff;font-weight: bold;">{{$polling->id==3?"IDOL TERFAVORIT":$polling_question->content}}</h3>
		<div id="canvas_wrapper">
			<canvas id="myChart"></canvas>
		</div>


	</div>
</div>
@endsection

@section('footer')
<script type="text/javascript">
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
		'{!!$row->polling_answer->content!!}',
		@endforeach
		],
		datasets: 
		[
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

					ctx.font = Chart.helpers.fontString(45, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
					ctx.fillStyle = "#ffffff"; 
					ctx.textAlign = 'center';
					ctx.textBaseline = 'bottom';

					this.data.datasets.forEach(function(dataset, i) {
						var meta = chartInstance.controller.getDatasetMeta(i);
						meta.data.forEach(function(bar, index) {
							var data = dataset.data[index];
							ctx.fillStyle = "#ffffff"; 
							ctx.fillText(data, bar._model.x, bar._model.y - 15);
						});
					});
				}
			},
			legend: {
				"display": false,
				labels: {
					fontColor: "#fff",
					fontSize: 20
				}
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
						max: Math.max(...data.datasets[0].data) + 40,
						display: false,
						beginAtZero: true
					}
				}],
				xAxes: [{
					gridLines: {
						display: false
					},
					ticks: {
						fontColor: "#ffffff",
						fontSize: 17,
						beginAtZero: true
					}
				}]
			}
		}

	});

</script>
@endsection