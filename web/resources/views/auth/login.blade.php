@extends('layouts.guest')

@section('content')
<div class="text-center  col-md-12" style="width:100%;padding:10px; background: rgba(255,255,255,0.4);">
    <div style="margin: 0 15%;">
      <br>
      Assalamualaikum Warahmatullahi Wabarakatuh
      <br>
      Dengan memohon rahmat dan ridho Allah SWT.
      <br>
      Kami bermaksud mengundang Bapak/Ibu/Saudara/i untuk berkenan hadir dan memberikan doa restu pada  pernikahan putra-putri kami:
      <br>
      <br>
      <b>Puti Faraniza</b>
      <br>
      Putri dari Bpk. Muhammad Diar Jaafar Hanafiah & Ibu Mirnawaty 
      <br>
      <br>
      Dengan 
      <br>
      <br>
      <b>Akbar Badriansyah</b>
      <br>
      Putra dari Bpk. Balarama Prakosa & Ibu Andam Dewi 
      <br>
      <br>

      Insya Allah akan di laksanakan pada :
      <br>
      Hari : Minggu
      <br>
      Tanggal : 13 Desember 2020
      <br>
      Tempat : Hotel Bidaraka, Birawa Assembly Hall
      <br>
      Jl. Jend. Gatot Subroto Kav. 71-73 Pancoran
      <br>
      Jakarta Selatan.
      <br>
      <br>
      Wassalamualaikum Warahmatullahi Wabarakatuh.
      <br>
  </div>
  <form class="form-signin" method="post" action="{{route('phoneLogin')}}">
    {{csrf_field()}}

    @if (\Session::has('message'))
    <div class="alert alert-danger">
      {!! \Session::get('message') !!}
  </div>
  @endif
  <br>
  Silahkan masukkan nomor HP Anda
  <input type="hidden" name="country_id" value="100">
  <input class="input-large" type="number" name="phone" id="phone" data-role="input" data-prepend="+62" placeholder="Nomor HP">
  <button class="mt-1 button shadowed primary col-md-12 large" type="submit" style="background-color: #82603B;">MASUK</button>
</form>
</div>
@endsection
