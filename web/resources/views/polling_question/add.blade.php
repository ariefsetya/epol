@extends('layout-single')

@section('content')

<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
	<a class="app-bar-item c-pointer" href="{{url('/core')}}">
		<span class="mif-home fg-white"></span>
	</a>
</div>
<div class="p-4">
    
    <h2>Tambah Data Pertanyaan Polling</h2>
    <form method="POST" action="{{route('polling_question.store')}}">
    	@include('polling_question._form')
    </form>

</div>
@endsection
