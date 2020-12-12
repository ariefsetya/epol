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
				<div style="height: 30px;"></div>
				{!! QrCode::size(150)->generate($guest->reg_number); !!}
				<div>
					<div style="height: 30px;"></div>
					<h3 style="margin:0;font-weight:bold;font-size: 15pt;font-family: 'Trajan Pro Regular';" id="name">{{$guest->name}}</h3>
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