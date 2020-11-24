@extends('layout-single')

@section('content')

<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
	<a class="app-bar-item c-pointer" href="{{url('/core')}}">
		<span class="mif-home fg-white"></span>
	</a>
</div>
<div class="p-4">
	<div class="p-2">
		<select id="category_id" data-role="select" class="input-large" data-prepend="Kategori">
			@foreach(\App\LotteryParticipantCategory::get() as $row)
			<option value="{{$row->id}}">{{$row->name}}</option>
			@endforeach
		</select>
	</div>
	<div class="p-2">
		<input id="qrcode" class="input-large" type="text" data-role="input" data-prepend="Scan QR Code" placeholder="Scan Here...">
	</div>
	<div class="p-2">
		<input id="number" readonly class="input-large" type="text" data-role="input" data-prepend="Nomor Undian">
	</div>
	<div class="p-2">
		<input id="name" readonly class="input-large" type="text" data-role="input" data-prepend="Nama">
	</div>
	<div class="p-2">
		<input id="city" readonly class="input-large" type="text" data-role="input" data-prepend="Kota">
	</div>
</div>
@endsection

@section('footer')

<script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
<script type="text/javascript">

	var s2 = io("{{env("SOCKET_URL")}}");

	$("#qrcode").on('keypress',function (e) {
		if(e.which == 13) {
			console.log("emit scan-" + $("#category_id").val());
			s2.emit('scan-'+$("#category_id").val(), $(this).val(), function(data){
				console.log(data)
				var result = data.split("-");
				$('#number').val(result[0]);
				$('#name').val(result[1]);
				$('#city').val(result[2]);
				// s2.emit('data', data);
			});
			$(this).val('')
		}
	});
</script>
@endsection