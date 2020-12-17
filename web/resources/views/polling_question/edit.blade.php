@extends('layout-single')

@section('content')

<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
	<a class="app-bar-item c-pointer" href="{{url('/core')}}">
		<span class="mif-home fg-white"></span>
	</a>
</div>
<div class="p-4">
    
    <h2>Ubah Data Pertanyaan Polling</h2>
    <form method="POST" action="{{route('polling_question.update',[$polling_question->id])}}" enctype="multipart/form-data">
    	<input type="hidden" name="_method" value="PUT">
    	@include('polling_question._form')
    </form>

</div>
@endsection
