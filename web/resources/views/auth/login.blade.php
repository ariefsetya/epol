@extends('layouts.guest')

@section('content')
<div class="text-center  col-md-3" style="margin-top:50%">
  <form class="form-signin" method="post" action="{{route('phoneLogin')}}">
    {{csrf_field()}}

    @if (\Session::has('message'))
    <div class="alert alert-danger">
      {!! \Session::get('message') !!}
    </div>
    @endif
    <br>
    Halo, selamat datang di Halaman RSVP<br>
    Pernikahan Fara & Akbar<br>
    <br>
    Silahkan masukkan nomor HP Anda
    <input type="hidden" name="country_id" value="100">
    <input class="input-large" type="number" name="phone" id="phone" data-role="input" data-prepend="+62" placeholder="Phone Number">
    <hr>
    <button class="button shadowed primary col-md-12 large" type="submit">MASUK</button>
  </form>
</div>
@endsection
