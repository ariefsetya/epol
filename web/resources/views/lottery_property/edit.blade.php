@extends('layout-single')

@section('content')
<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
	<a class="app-bar-item c-pointer" href="{{url('/admin/lottery_property')}}">
		<span class="mif-arrow-left fg-white"></span>
	</a>
</div>
<div class="p-4">

	<h2>Ubah Data Lottery Property</h2>
	<form method="POST" action="{{route('lottery_property.update',[$lottery_property->id])}}"  enctype="multipart/form-data">
		<input type="hidden" name="_method" value="PUT">
		@include('lottery_property._form')
	</form>

</div>
@endsection
