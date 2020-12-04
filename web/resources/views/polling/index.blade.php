@extends('layout-single')

@section('content')

<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
    <a class="app-bar-item c-pointer" href="{{url('/core')}}">
        <span class="mif-home fg-white"></span>
    </a>
</div>
<div class="p-4">
    <h2>Data Polling
    <a class="button primary float-right" href="{{route('polling.create')}}">Tambah</a></h2>
    <table class="table">
    	<thead>
    		<tr>
	    		<th>Tipe Polling</th>
	    		<th>Nama</th>
                <th>Pesan Selesai</th>
	    		<th colspan="3">Action</th>
	    	</tr>
    	</thead>
    	<tbody>
    		@foreach($polling as $key)
    			<tr>
    				<td>{{$key->polling_type->name}}</td>
    				<td>{{$key->name}}</td>
                    <td>{{$key->finish_message}}</td>
    				<td>@if($key->polling_type_id==3)<a class="button warning" href="{{route('quiz_display_report',[$key->id])}}">Quiz Display Report</a>@elseif($key->polling_type_id==5)<a class="button warning" href="{{route('polling_essay_report',[$key->id])}}">Polling Essay Report</a>@endif</td>
                    <td><a class="button warning" href="{{route('polling.edit',[$key->id])}}">Edit</a></td>
    				<td><form method="POST" action="{{route('polling.destroy',[$key->id])}}">{{csrf_field()}}<input type="hidden" name="_method" value="DELETE">
    					<button type="submit" class="button danger">Delete</button></form></td>
    			</tr>
    		@endforeach
    	</tbody>
    </table>
    {{$polling->links('vendor.pagination.simple-bootstrap-4')}}
</div>
@endsection
