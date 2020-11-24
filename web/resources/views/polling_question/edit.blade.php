@extends('layouts.app')

@section('content')
<div class="">
    
    <h2>Ubah Data Pertanyaan Polling</h2>
    <form method="POST" action="{{route('polling_question.update',[$polling_question->id])}}">
    	<input type="hidden" name="_method" value="PUT">
    	@include('polling_question._form')
    </form>

</div>
@endsection
