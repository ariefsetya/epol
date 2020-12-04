@extends('layout-single')

@section('content')

<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
	<a class="app-bar-item c-pointer" href="{{url('/core')}}">
		<span class="mif-home fg-white"></span>
	</a>
</div>
<div class="p-4">
	<h2>Setting</h2>
	<div class="col-md-6">

		<select id="property">
			@foreach($lottery_property as $key)
			<option value="{{$key->display_image_url}}|{{$key->report_image_url}}">{{$key->name}}</option>
			@endforeach
		</select>
		<hr>
		<a onclick="applyproperty()" class="button primary">Apply</a>
	</div>
</div>
@endsection

@section('footer')

<script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
<script type="text/javascript">

	var s2 = io("{{env("SOCKET_URL")}}");

	function applyproperty() {
		var data = $("#property").val();
		s2.emit('change-background', data, function(data){
			console.log(data)
		});
	}
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