@extends('layouts.app')

@section('content')
<div class="">
    <h2>Laporan Polling {{$polling->name}}</h2>
    <hr>
    <div class="row">
    @foreach($result as $key)
    	<div class="col-md-4">
    		<p><a href="{{route('polling.detail',[$polling->id, $key->id])}}">{{$key->content}}</a></p>
			<canvas id="myChart{{$key->id}}" height="300"></canvas>
		</div>
	@endforeach
	</div>


</div>
@endsection

@section('footer')
<script>
    @foreach($result as $key)
	var ctx = document.getElementById('myChart{{$key->id}}');
	
	var myChart = new Chart(ctx, {
	    type: 'bar',
	    data: {
	        labels: [ @foreach($key->polling_response as $row) '{{$row->polling_answer->content}}', @endforeach ],
	        datasets: [{
	            data: [ @foreach($key->polling_response as $row) '{{$row->total}}', @endforeach ],
	            backgroundColor: [
	                'rgba(255, 99, 132, 0.7)',
	                'rgba(54, 162, 235, 0.7)',
	                'rgba(255, 206, 86, 0.7)',
	                'rgba(75, 192, 192, 0.7)',
	                'rgba(153, 102, 255, 0.7)',
	                'rgba(255, 159, 64, 0.7)'
	            ],
	            borderColor: [
	                'rgba(255, 99, 132, 1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)',
	                'rgba(75, 192, 192, 1)',
	                'rgba(153, 102, 255, 1)',
	                'rgba(255, 159, 64, 1)'
	            ],
	            borderWidth: 1
	        }]
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
		        display: false
		    }
	    }
	});
	@endforeach
	</script>
@endsection