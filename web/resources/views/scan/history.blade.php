@extends('layout-single')

@section('content')

<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
    <a class="app-bar-item c-pointer" href="{{url('/core')}}">
        <span class="mif-home fg-white"></span>
    </a>
</div>
<div class="p-4">
    <h2>Laporan Scan Undian
    <a class="btn btn-primary float-right" href="{{route('scan_history.export_excel')}}">Export</a></h2>
    <table class="table for_datatables">
    	<thead>
    		<tr>
	    		<th>Category</th>
	    		<th>Kode Undangan</th>
                <th>Nama Dealer</th>
                <th>Kota</th>
                <th>Status</th>
                <th>Waktu</th>
	    	</tr>
    	</thead>
    	<tbody>
    		@foreach($history as $key)
            <?php $x = 0; ?>
    			<tr>
    				<td>{{$key->lottery_participant->lottery_participant_category->name}}</td>
                    <td>{{$key->lottery_participant->number}}</td>
                    <td>{{$key->lottery_participant->name}}</td>
                    <td>{{$key->lottery_participant->city}}</td>
                    <td>{{$key->status==1?'WIN':'LOSS'}}</td>
                    <td>{{$key->created_at!=null?date_format($key->created_at,"H:i:s"):""}}</td>
    			</tr>
    		@endforeach
    	</tbody>
    </table>
</div>
@endsection
