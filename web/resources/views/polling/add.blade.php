@extends('layout-single')

@section('content')

<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
	<a class="app-bar-item c-pointer" href="{{url('/core')}}">
		<span class="mif-home fg-white"></span>
	</a>
</div>
<div class="p-4">
    
    <h2>Tambah Data Polling</h2>
    <form method="POST" action="{{route('polling.store')}}">
    	@include('polling._form')
    </form>

</div>
@endsection
