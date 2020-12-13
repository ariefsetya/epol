@extends('layout-single')

@section('content')

<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
	<a class="app-bar-item c-pointer" href="{{url('/core')}}">
		<span class="mif-home fg-white"></span>
	</a>
</div>
<div class="p-4">
	<div class="p-2">
		<select id="session" data-prepend="Session">
			@foreach($session as $key)
			<option value="{{$key->session_invitation}}">{{$key->session_invitation}} ({{$key->jumlah}})</option>
			@endforeach
		</select>
	</div>
	@if($result)
	@foreach($result['seat'] as $key)
	<h2>{{$key->seat_number}}</h2>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Seat Number</th>
				<th>Session</th>
				<th>Group</th>
				<th>RSVP Time</th>
				<th>Scan By</th>
				<th>Scan Time</th>
			</tr>
		</thead>
		<tbody id="content">
			@foreach(\App\RSVP::where('event_id',Session::get('event_id'))->where('seat_number',$key->seat_number)->where('session_invitation',$result['session'])->whereIn('user_id',\App\User::where('event_id',Session::get('event_id'))->get()->pluck('id'))->get() as $row)
			<tr>
				<td>{{$row->user->name}}</td>
				<td>{{$row->user->email}}</td>
				<td>{{$row->user->phone}}</td>
				<td>{{$row->user->rsvp->seat_number}}</td>
				<td>{{$row->user->rsvp->session_invitation}}</td>
				<td>{{$row->user->rsvp->custom_field_2}}</td>
				<td>{{\App\Presence::whereUserId($row->user->id)->first()->created_at ?? ''}}</td>
				<td>{{\App\Presence::whereUserId($row->user->id)->whereVia('scan')->first()->via_info ?? ''}}</td>
				<td>{{\App\Presence::whereUserId($row->user->id)->whereVia('scan')->first()->created_at ?? ''}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@endforeach
	@endif
	<iframe name="theFrame" style="border:0;width: 1px;height: 1px;opacity: 0"></iframe>
</div>
@endsection
@section('footer')
<script type="text/javascript">
	$("#session").on('change',function() {
		window.location='{{url('rsvp/seat')}}/'+$("#session").val()
	});
</script>
@endsection