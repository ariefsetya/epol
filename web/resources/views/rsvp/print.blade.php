<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link rel="stylesheet" type="text/css" href="{{url('css/style.css')}}">
</head>
<body style="margin: 0;padding: 0">
	<div style="width: 72mm;">
		<div style="margin:0 auto">
			<div style="background-color: white;text-align: center;font-family: 'Trajan Pro Regular';">
				<img src="{{url('images/fa-logo.jpeg')}}" style="width: 150px;">
				<div>

					<div style="height: 30px;"></div>
					<h3 style="margin:0;font-size: 12pt;font-family: 'Trajan Pro Regular';">Selamat Datang</h3>
					<div style="height: 30px;"></div>
					<h3 style="margin:0;font-weight:bold;font-size: 15pt;font-family: 'Trajan Pro Regular';" id="name">{{$guest->name}}</h3>
					<div style="height: 30px;"></div>
					Nomor Meja :
					<h3 style="font-weight:bold;font-size: 55pt;margin:0;font-family: 'Trajan Pro Regular';">{{$guest->rsvp->seat_number}}</h3>
					<div style="height: 30px;"></div>
					<h3 style="margin:0;font-size: 12pt;font-family: 'Trajan Pro Regular';">Jumlah Tamu : {{$guest->rsvp->guest_qty}}</h3>
					<div style="height: 30px;"></div>
					<h3 style="margin:0;font-size: 10pt;font-family: 'Trajan Pro Regular';">{{$guest->rsvp->session_invitation}}. {{$guest->rsvp->event_time}}</h3>
					<div style="height: 30px;">&nbsp;</div>
				</div>
			</div>
		</div>
	</div>
	<script src="{{url('vendors/jquery/jquery-3.4.1.min.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			window.print();
		});
	</script>


</body>
</html>