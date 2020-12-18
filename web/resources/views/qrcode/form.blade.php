@extends('layout-single')

@section('content')

<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
	<a class="app-bar-item c-pointer" href="{{url('/core')}}">
		<span class="mif-home fg-white"></span>
	</a>
</div>
<div class="p-4">
	<form method="POST" action="{{url('generateQR')}}">
		{{csrf_field()}}
		<div class="p-2">
			<input id="code" class="input-large" type="text" data-role="input" data-prepend="Text">
		</div>
		<button type="submit" class="button primary">Generate</button>
	</form>
</div>
@endsection
