@extends('layout-single')

@section('content')

<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
	<a class="app-bar-item c-pointer" href="{{url('/core')}}">
		<span class="mif-home fg-white"></span>
	</a>
</div>
<div class="p-4">
    
    <h2>Ubah Data Jawaban Polling</h2>
    <form method="POST" action="{{route('polling_answer.update',[$polling_answer->id])}}">
    	<input type="hidden" name="_method" value="PUT">
    	@include('polling_answer._form')
    </form>

</div>
@endsection
