@extends('layout-single')

@section('content')

<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
	<a class="app-bar-item c-pointer" href="{{url('/core')}}">
		<span class="mif-home fg-white"></span>
	</a>
</div>
<div class="p-4">
	<div class="p-2">
		<div class="row">
			<div class="col-md-6">

				<select id="gift_id" data-role="select" class="input-large" data-prepend="Hadiah">
					@foreach(\App\Gift::get() as $row)
					<option value="{{$row->id}}">{{$row->name}} ({{$row->qty}})</option>
					@endforeach
				</select>
				<hr>
				<button id="action" class="button primary large" style="width: 100%;">Initialize</button>

			</div>
			<div class="col-md-6">
				<table class="table striped table-border" style="margin: 0">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nama</th>
							<th>Hadiah</th>
							<th>Waktu</th>
						</tr>
					</thead>
					<tbody id="winner_list">
						@foreach(\App\LotteryHistory::whereEventId(Session::get('event_id'))->get() as $row)

						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

@section('footer')
<script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
<script type="text/javascript">
	var state = '';
	var s2 = io("{{env("SOCKET_URL")}}");
	$("#action").on('click',function() {
		if(state == ''){
			getWinners();
		}else if(state == 'initialized'){
			startApps();
		}
	});
	async function getWinners() {
		try {
			let r = await fetch("{{url('/lottery/winners')}}", {method: "GET"})
			.then(response => response.text())
			.then(data => {
				var server_data = data.split("-");
				for (var i = 0; i < server_data.length; i++) {
					var split = server_data[i].split("|");
					var number = split[0];
					var name = split[1];
					$("#winner_list").append('<tr><td>'+number+'</td><td>'+name+'</td><td>Gift</td><td>'+(new Date())+'</td>');
				}
				s2.emit('winners', data, function(result){
					console.log(result)
					$("#action").html('Start');
					state = 'initialized';
				});
			}); 
		} catch(e) {
			console.log('error:', e);
		}
	}
	async function startApps() {
		s2.emit('start', '', function(data){
			console.log(data)
			$("#action").html('Initialize');
			state = '';
		});
	}
</script>
@endsection