@extends('layout-single')

@section('content')

<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
    <a class="app-bar-item c-pointer" href="{{url('/core')}}">
        <span class="mif-home fg-white"></span>
    </a>
</div>
<div class="p-4">
    <h2>Laporan {{$polling->name}}
    <a class="btn btn-primary float-right" href="{{route('quiz.export_excel',[$polling->id])}}">Export</a></h2>
    <table class="table for_datatables">
    	<thead>
    		<tr>
	    		<th>Nama</th>
	    		<th>Dealer</th>
                @foreach(\App\PollingQuestion::where('event_id',Session::get('event_id'))->where('polling_id',$polling->id)->get() as $key => $val)
                <th>Pertanyaan {{$key+1}}</th>
                @endforeach
                <th>Total</th>
                <th>Waktu</th>
                <th>Status</th>
                <th>Action</th>
	    	</tr>
    	</thead>
    	<tbody>
    		@foreach($polling_participant as $key)
            <?php $x = 0; ?>
    			<tr>
    				<td>{{$key->user->name}}</td>
                    <td>{{$key->user->company}}</td>
                    @foreach(\App\PollingQuestion::where('event_id',Session::get('event_id'))->where('polling_id',$polling->id)->get() as $row => $val)
                        <?php $win = isset(\App\PollingResponse::where('event_id',Session::get('event_id'))->where('polling_id',$polling->id)->where('user_id',$key->user->id)->where('polling_question_id',$val->id)->first()->is_winner)?\App\PollingResponse::where('event_id',Session::get('event_id'))->where('polling_id',$polling->id)->where('user_id',$key->user->id)->where('polling_question_id',$val->id)->first()->is_winner:0;?>
                        <td>{{$win==1?'Benar':'Salah'}}</td>
                        <?php $x+= $win; ?>
                    @endforeach
                    <td>{{$x}}</td>
                    <td>{{$key->created_at}}</td>
                    <td>{{$key->is_winner==1?'Menang':'Tidak Menang'}}</td>
                    <td><a class="btn btn-danger" href="{{route('polling_response.reset',[$polling->id, $key->user->id])}}">Reset</a></td>
    			</tr>
    		@endforeach
    	</tbody>
    </table>
</div>
@endsection
