@extends('layouts.app')

@section('content')
<div class="">
    
    <h2>Tambah Data Polling</h2>
    <form method="POST" action="{{route('polling.store')}}">
    	@include('polling._form')
    </form>

</div>
@endsection
