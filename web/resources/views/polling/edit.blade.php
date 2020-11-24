@extends('layouts.app')

@section('content')
<div class="">
    
    <h2>Ubah Data Polling</h2>
    <form method="POST" action="{{route('polling.update',[$polling->id])}}">
    	<input type="hidden" name="_method" value="PUT">
    	@include('polling._form')
    </form>

</div>
@endsection
