@extends('layout-single')

@section('content')
<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
	<a class="app-bar-item c-pointer" href="{{url('/admin/event_detail')}}">
		<span class="mif-arrow-left fg-white"></span>
	</a>
</div>
<div class="p-4">
    
    <h2>Tambah Data Detail Event</h2>
    <form method="POST" action="{{route('event_detail.store')}}"  enctype="multipart/form-data">
    	@include('event_detail._form')
    </form>

</div>
@endsection
