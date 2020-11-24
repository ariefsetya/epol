@extends('layouts.app')

@section('content')
<div class="">
    
    <h2>Tambah Data Jawaban Polling</h2>
    <form method="POST" action="{{route('polling_answer.store')}}">
    	@include('polling_answer._form')
    </form>

</div>
@endsection
