@extends('layouts.app')

@section('content')
<div class="">
    <h2>Data Polling
    <a class="btn btn-primary float-right" href="{{route('polling.create')}}">Tambah</a></h2>
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
    				<td><a class="btn btn-warning" href="{{route('polling.edit',[$key->id])}}">Edit</a></td>
    				<td><form method="POST" action="{{route('polling.destroy',[$key->id])}}">{{csrf_field()}}<input type="hidden" name="_method" value="DELETE">
    					<button type="submit" class="btn btn-danger">Delete</button></form></td>
    			</tr>
    		@endforeach
    	</tbody>
    </table>
    {{$polling->links('vendor.pagination.simple-bootstrap-4')}}
</div>
@endsection
