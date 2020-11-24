@extends('layouts.chart')

@section('content')
<div class="container">
	<br>
    <h3 class="text-center">{{$summary->product->code}}</h3>
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
	    type: 'pie',
	    data: {
	    	labels:['Yes ({{$summary->yes}})', 'No ({{$summary->no}})'],
	        datasets: [

	        {
	            data: [ '{{$summary->yes}}','{{$summary->no}}'  ],
	            backgroundColor:[bgColor[0]],
	            borderColor:[bdColor[0]],
	            borderWidth: 1
	        }
	        

	        ]
	    },
	    options: {
		    legend: {
		        display: true,
		        labels:{
		        	fontSize:25
		        },
		        align:'center',
		        position:'right'
		    },
		    tooltips: {
		         enabled: false
		    }
	    }
	});
	</script>
@endsection