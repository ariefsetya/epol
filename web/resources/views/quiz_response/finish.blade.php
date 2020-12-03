@extends('layouts.guest')

@section('content')

<div class="col-md-3" style="margin:0 auto;">
	<div style="margin-top:25%;" class="text-center" >
		<h3>Selamat! Anda telah menyelesaikan Quiz</h3>
		<br>
		<h3>Jawaban benar<br><b><span style="font-size: 80pt;">{{$benar}}</span></b></h3>
		<h5>dari 10 pertanyaan</h5>
		<br>
		<h3>Waktu menjawab<br><b><span style="font-size: 40pt;">{{$time}}</span></b></h3>
	</div>
	<div style="width: calc(100% - 20px);padding:10px;position: fixed;bottom:0;" class="text-center">
		<a href="{{url('/')}}" class="mt-1 button primary large" style="width:60%;border-radius: 100px;left:0;bottom: 0;" type="submit">SELESAI</a>
	</div>
</div>
@endsection