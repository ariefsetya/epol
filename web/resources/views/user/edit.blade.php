@extends('layout-single')

@section('content')
<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
	<a class="app-bar-item c-pointer" href="{{url('/admin/user')}}">
		<span class="mif-arrow-left fg-white"></span>
	</a>
</div>
<div class="p-4">
    
    <h2>Ubah Data Tamu</h2>
    <form method="POST" action="{{route('user.update',[$user->id])}}">
    	<input type="hidden" name="_method" value="PUT">
    	@include('user._form')
    </form>

</div>
@endsection
