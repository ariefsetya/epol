@extends('layout-single')

@section('content')

<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
	<a class="app-bar-item c-pointer" href="{{url('/core')}}">
		<span class="mif-home fg-white"></span>
	</a>
</div>
<div class="p-4">
    
    <h2>Ubah Data Polling</h2>
    <form method="POST" action="{{route('polling.update',[$polling->id])}}">
    	<input type="hidden" name="_method" value="PUT">
    	@include('polling._form')
    </form>

</div>
@endsection
