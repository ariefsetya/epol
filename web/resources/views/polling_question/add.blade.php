@extends('layouts.app')

@section('content')
<div class="">
    
    <h2>Tambah Data Pertanyaan Polling</h2>
    <form method="POST" action="{{route('polling_question.store')}}">
    	@include('polling_question._form')
    </form>

</div>
@endsection
