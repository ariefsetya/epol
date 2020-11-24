@extends('layout-single')

@section('content')
<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
    <a class="app-bar-item c-pointer" href="{{url('/core')}}">
        <span class="mif-home fg-white"></span>
    </a>
</div>
<div class="p-4">
    <h2>Laporan Kehadiran
    <a class="button primary float-right" href="{{route('user.export_excel')}}">Export</a></h2>
    <table class="table for_datatables">
    	<thead>
    		<tr>
	    		<th>Kode</th>
                <th>Nama</th>
                <th>E-Mail</th>
                <th>Telp</th>
	    		<th>Perusahaan</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Check In</th>
	    	</tr>
    	</thead>
    	<tbody>
    		@foreach($presence as $key)
                @if($key[0]!='Kode')
        			<tr>
        				<td>{{$key[0]}}</td>
                        <td>{{$key[1]}}</td>
                        <td>{{$key[2]}}</td>
                        <td>{{$key[3]}}</td>
                        <td>{{$key[4]}}</td>
                        <td>{{$key[5]}}</td>
                        <td>{{$key[6]}}</td>
                        <td>{{$key[7]}}</td>
        			</tr>
        		@endif
            @endforeach
    	</tbody>
    </table>
</div>
@endsection
