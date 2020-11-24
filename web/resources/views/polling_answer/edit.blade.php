@extends('layouts.app')

@section('content')
<div class="">
    
    <h2>Ubah Data Jawaban Polling</h2>
    <form method="POST" action="{{route('polling_answer.update',[$polling_answer->id])}}">
    	<input type="hidden" name="_method" value="PUT">
    	@include('polling_answer._form')
    </form>

</div>
@endsection
