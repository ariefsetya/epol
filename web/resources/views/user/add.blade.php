@extends('layout-single')

@section('content')
<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
	<a class="app-bar-item c-pointer" href="{{url('/admin/user')}}">
		<span class="mif-arrow-left fg-white"></span>
	</a>
</div>
<div class="p-4">
    
    <h2>Tambah Data Tamu</h2>
    <form method="POST" action="{{route('user.store')}}">
    	@include('user._form')
    </form>

</div>
@endsection
