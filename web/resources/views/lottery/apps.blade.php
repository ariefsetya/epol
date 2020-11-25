@extends('layout-single')

@section('content')

<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
	<a class="app-bar-item c-pointer" href="{{url('/core')}}">
		<span class="mif-home fg-white"></span>
	</a>
</div>
<div class="p-4">
	<div class="p-2">
		<div class="row" id="rows">
		</div>
	</div>
</div>
@endsection

@section('footer')
<script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
<script type="text/javascript">
	var s2 = io("{{env("SOCKET_URL")}}");
	var server_data = [];
	var split = [];
	var x = [];
	var name = [];
	var length = [];
	var inside = [];
	var number = [];
	var state = '';
	function sleep(ms) {
		return new Promise(resolve => setTimeout(resolve, ms));
	}
	function generate0(length) {
		var x = '';
		for (var i = 0; i < length; i++) {
			x += 'X';
		}
		return x;
	}

	s2.on('initialize',async function(msg){
		$("#rows").html('');
		var data = msg.split("-");
		server_data = data;
		for (var i = 0; i < data.length; i++) {
			var split = data[i].split("|");
			var number = split[0];
			var name = split[1];
			var html = '<div class="col-md-6">';
			html += '<div class="more-info-box bg-green fg-white">';
			html += '<div class="content">';
			html += '<h1 style="font-size:50pt;" class="text-bold mb-0" id="number_'+number+'">'+generate0(number.length)+'</h1>';
			html += '</div>';
			html += '<div class="icon">';
			html += '<span class="mif-trophy"></span>';
			html += '</div>';
			html += '<a href="#" class="more" style="font-weight:bold;text-align:left;opacity:0" id="name_'+number+'">'+name+'</a>';
			html += '</div>';
			html += '</div>';
			$("#rows").append(html);
		}
	});
	s2.on('start',async function(msg){

		for (var i = 0; i < server_data.length; i++) {
			var x = 0;
			var split = server_data[i].split("|");
			var number = split[0];
			var name = split[1];
			var length = number.length;

			while(x<length){
				$("#number_"+number).html(number.substring(0, length-(length-x)) + getRandomString(1) + generate0(length - x - 1))
				x++;
				await sleep(50);
			}
			$("#name_"+number).css('opacity',1);
		}
	});

	function getRandomString(length) {
		var randomChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		var result = '';
		for ( var i = 0; i < length; i++ ) {
			result += randomChars.charAt(Math.floor(Math.random() * randomChars.length));
		}
		return result;
	}
</script>
@endsection