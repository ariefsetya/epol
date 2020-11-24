@extends('layouts.app')

@section('content')
<div class="">
    <h2>Data Pertanyaan Polling
    <a class="btn btn-primary float-right" href="{{route('polling_question.create')}}">Tambah</a></h2>
    <table class="table">
    	<thead>
    		<tr>
	    		<th>Polling</th>
	    		<th>Isi</th>
	    		<th colspan="2">Action</th>
	    	</tr>
    	</thead>
    	<tbody>
    		@foreach($polling_question as $key)
    			<tr>
    				<td>{{$key->polling->name}}</td>
    				<td>{{$key->content}}</td>
    				<td><a class="btn btn-warning" href="{{route('polling_question.edit',[$key->id])}}">Edit</a></td>
    				<td><form method="POST" action="{{route('polling_question.destroy',[$key->id])}}">{{csrf_field()}}<input type="hidden" name="_method" value="DELETE">
    					<button type="submit" class="btn btn-danger">Delete</button></form></td>
    			</tr>
    		@endforeach
    	</tbody>
    </table>
    {{$polling_question->links('vendor.pagination.simple-bootstrap-4')}}
</div>
@endsection
