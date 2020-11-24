@extends('layouts.app')

@section('content')
<div class="">
    <h2>Data Laporan Polling</h2>
    <table class="table">
    	<thead>
    		<tr>
	    		<th>Tipe Polling</th>
	    		<th>Nama</th>
	    		<th colspan="3">Action</th>
	    	</tr>
    	</thead>
    	<tbody>
    		@foreach($polling as $key)
    			<tr>
    				<td>{{$key->polling_type->name}}</td>
    				<td>{{$key->name}}</td>
    				<td><a class="btn btn-info" href="{{route('polling.show',[$key->id])}}">Detail</a></td>
                    <td><a class="btn btn-info" href="{{route('quiz_report',[$key->id])}}">Report</a></td>
                    <td>@if($key->polling_type_id==3) <a class="btn btn-info" href="{{route('quiz_result',[$key->id])}}">Result Screen</a>@endif</td>
    			</tr>
    		@endforeach
    	</tbody>
    </table>
</div>
@endsection
