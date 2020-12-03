@extends('layouts.guest')

@section('content')
@if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content=='rsvp')
<div class="text-center  col-md-12" style="width:100%;padding:10px; background: rgba(255,255,255,0.6);">
    <div style="margin: 0 15%;">
      <br>
      Assalamualaikum Warahmatullahi Wabarakatuh
      <br>
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
  @else
  <div class="text-center col-md-12" style="width:100%;margin-top:50%;padding:10px;">
      @endif
      <form class="form-signin" method="post" action="{{route('phoneLogin')}}">
        {{csrf_field()}}
        <br>
        @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content=='rsvp')
        Silahkan masukkan Nomor Handphone Anda untuk konfirmasi kehadiran
        @else
        Silahkan masukkan kode undangan Anda untuk melanjutkan
        @endif
        <input type="hidden" name="country_id" value="100">
        @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content=='rsvp')
        <input class="input-large" required type="number" name="phone" id="phone" data-role="input" data-prepend="+62" placeholder="Nomor HP">
        @else
        <input class="input-large" required type="text" name="code" id="code" data-role="input" placeholder="Kode Undangan">
        @endif
        @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content=='rsvp')
        <button class="mt-1 button shadowed primary col-md-12 large" type="submit" style="background-color: #82603B;">MASUK</button>
    </form>
</div>
@else
<button class="mt-1 button shadowed primary col-md-12 large" type="submit">MASUK</button>
</form>
</div>
@endif

@endsection

@section('footer')
<script type="text/javascript">
    @if (\Session::has('message'))
    Metro.dialog.create({
        title: "Informasi",
        content: "{!! \Session::get('message') !!}",
        closeButton: true
    });
    @endif
</script>
@endsection