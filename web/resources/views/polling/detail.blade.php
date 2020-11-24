@extends('layouts.chart')

@section('content')
<div class="container">
	<br>
    <h3 class="text-center" style="color:#000000;font-weight: bold;">{{$polling->id==5?"MOST REQUESTED SONGS":$polling_question->content}}</h3>
    <hr>
	<canvas id="myChart"></canvas>


</div>
@endsection

@section('footer')
<script type="text/javascript" src="{{url('')}}:9000/socket.io/socket.io.js"></script>
<script type="text/javascript">
  var socket = io("{{url('')}}:9000");

	  socket.on('screen.change',function(msg) {
	    $("body").fadeOut(500);
	    setTimeout(function () {
	      window.location = msg
	    },500);
	  });
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

	var myChart = new Chart(ctx, {
	    type: 'bar',
	    data: {
	    	labels:[''],
	        datasets: [
	        @foreach($polling_response as $row)

	        {
	        	label:'{{$row->polling_answer->content}}',
	            data: [ '{{$row->total}}'  ],
	            backgroundColor:[bgColor[{{$i}}]],
	            borderColor:[bdColor[{{$i++}}]],
	            borderWidth: 1
	        },
	        
	        @endforeach

	        ]
	    },
	    options: {
	        scales: {
	            yAxes: [{
	                ticks: {
	                    beginAtZero: true,
		                userCallback: function(label, index, labels) {
		                    if (Math.floor(label) === label) {
		                        return label;
		                    }

		                }
	                }
	            }]
	        },
		    legend: {
		        display: true,
		        labels:{
		        	fontSize:25,
		        	
			      	generateLabels: function(chart){
			          var data = chart.data;
			          var legends = Array.isArray(data.datasets) ? data.datasets.map(function(dataset, i) {
			          	console.log(dataset);
			            return {
			              text: dataset.label+" ("+dataset.data+")",
			              fillStyle: (!Array.isArray(dataset.backgroundColor) ? dataset.backgroundColor : dataset.backgroundColor[0]),
			              hidden: !chart.isDatasetVisible(i),
			              lineCap: dataset.borderCapStyle,
			              lineDash: dataset.borderDash,
			              lineDashOffset: dataset.borderDashOffset,
			              lineJoin: dataset.borderJoinStyle,
			              lineWidth: dataset.borderWidth,
			              strokeStyle: dataset.borderColor,
			              pointStyle: dataset.pointStyle,

			              // Below is extra data used for toggling the datasets
			              datasetIndex: i
			            };
			          }, this) : [];
			          return legends;
			        }
		        },
		        align:'center',
		        position:'right'
		    },

		    showTooltips: false,
		    onAnimationComplete: function () {

		        var ctx = this.chart.ctx;
		        ctx.font = this.scale.font;
		        ctx.fillStyle = this.scale.textColor
		        ctx.textAlign = "center";
		        ctx.textBaseline = "bottom";

		        this.datasets.forEach(function (dataset) {
		            dataset.bars.forEach(function (bar) {
		                ctx.fillText(bar.value, bar.x, bar.y - 5);
		            });
		        })
		    }
	    }
		    
	});

	</script>
@endsection