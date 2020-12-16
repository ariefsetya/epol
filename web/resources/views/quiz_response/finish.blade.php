@extends('layouts.guest')

@section('content')

<div style="margin:0 auto;padding: 10px;color: white;">
	<div style="margin-top:15%;" class="text-center" >
		<div style="background-color: rgba(0,0,0,0.4);">
		<br>
		<h3>Selamat! Anda telah menyelesaikan Quiz</h3>
		<br>
			<h3>Jawaban benar<br><b><span style="font-size: 80pt;">{{$benar}}</span></b></h3>
			<h5>dari {{$question}} pertanyaan</h5>
		<br>
		<h3>Waktu menjawab<br><b><span style="font-size: 40pt;">{{$time}}</span></b></h3>
		<br>
		</div>
	</div>
	<div style="width: 100%;padding:10px;position: relative;" class="text-center">
		<a href="{{url('/')}}" class="mt-1 button primary large" style="padding:0px 25px;background-color: #EB2228;color:white;font-family: 'Lato';font-weight: 700;font-size: 17pt;border-radius: 10px;width:60%;margin:0 auto;" type="submit">SELESAI</a>
		<br>
		<br>
	</div>
</div>
@endsection