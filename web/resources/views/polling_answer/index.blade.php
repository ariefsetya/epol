@extends('layouts.app')

@section('content')
<div class="">
    <h2>Data Jawaban Polling
    <a class="btn btn-primary float-right" href="{{route('polling_answer.create')}}">Tambah</a></h2>
    <table class="table">
    	<thead>
    		<tr>
                <th>Pertanyaan</th>
	    		<th>Isi</th>
	    		<th colspan="2">Action</th>
	    	</tr>
    	</thead>
    	<tbody>
    		@foreach($polling_answer as $key)
    			<tr>
                    <td>{{$key->polling_question->content}}</td>
    				<td>{{$key->content}}</td>
    				<td><a class="btn btn-warning" href="{{route('polling_answer.edit',[$key->id])}}">Edit</a></td>
    				<td><form method="POST" action="{{route('polling_answer.destroy',[$key->id])}}">{{csrf_field()}}<input type="hidden" name="_method" value="DELETE">
    					<button type="submit" class="btn btn-danger">Delete</button></form></td>
    			</tr>
    		@endforeach
    	</tbody>
    </table>
    {{$polling_answer->links('vendor.pagination.simple-bootstrap-4')}}
</div>
@endsection
