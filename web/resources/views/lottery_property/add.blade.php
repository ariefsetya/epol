@extends('layout-single')

@section('content')
<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
	<a class="app-bar-item c-pointer" href="{{url('/admin/lottery_property')}}">
		<span class="mif-arrow-left fg-white"></span>
	</a>
</div>
<div class="p-4">
    
    <h2>Tambah Data Lottery Property</h2>
    <form method="POST" action="{{route('lottery_property.store')}}"  enctype="multipart/form-data">
    	@include('lottery_property._form')
    </form>

</div>
@endsection
