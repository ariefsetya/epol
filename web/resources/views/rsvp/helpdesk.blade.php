@extends('layout-single')

@section('content')

<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
	<a class="app-bar-item c-pointer" href="{{url('/core')}}">
		<span class="mif-home fg-white"></span>
	</a>
</div>
<div class="p-4">
	<div class="p-2">
		<input id="param" class="input-large" type="text" data-role="input" data-prepend="Search" placeholder="Search">
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>Phone</th>
				<th>Email</th>
				<th>Nomor Meja</th>
				<th>Print Seat Number</th>
				<th>Print QR Code</th>
			</tr>
		</thead>
		<tbody id="content">
			
		</tbody>
	</table>
	<iframe name="theFrame" style="border:0;width: 1px;height: 1px;opacity: 0"></iframe>
</div>
@endsection

@section('footer')

<script type="text/javascript">
	$("#param").on('keyup',function() {
		$.ajax({
			url:'{{url('rsvp/search')}}/'+$("#param").val(),
			dataType:'json',
			success:function(result) {
				$("#content").html('');
				var html = '';
				for (var i = 0; i < result.length; i++) {
					html += '<tr><td>'+result[i].name+'</td><td>'+result[i].email+'</td><td>'+result[i].phone+'</td><td>'+result[i].rsvp.seat_number+'</td><td><span onclick="popitup(\'{{url('rsvp/print')}}/'+result[i].reg_number+'/Helpdesk\');" class="button primary">Print Seat Number</span></td><td><span onclick="popitup(\'{{url('rsvp/print_qr')}}/'+result[i].reg_number+'\');" class="button primary">Print QR Code</span></td></tr>';
				}
				$("#content").html(html);
			}
		})

	})
	function popitup(url) {
		window.open(url, "theFrame");
	}
</script>
@endsection