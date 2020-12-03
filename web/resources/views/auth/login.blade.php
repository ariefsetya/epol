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
  <div class="col-md-12" style="width:100%;margin-top:50%;padding:10px;">
    @endif
    <form class="form-signin" method="post" action="{{route('phoneLogin')}}">
      {{csrf_field()}}
      <br>
      <div class="text-center">
        @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content=='rsvp')
        Silahkan masukkan Nomor Handphone Anda untuk konfirmasi kehadiran
        @else
        Silahkan masukan<br>Nomor Undangan Anda<br>untuk melanjutkan
        @endif
      </div>
      <br>
      <input type="hidden" name="country_id" value="100">
      @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content=='rsvp')
      <input class="input-large" required type="number" name="phone" id="phone" data-role="input" data-prepend="+62" placeholder="Nomor HP">
      @else
      <div style="margin: 0 10%;" class="text-center">
        <input class="input-large text-center" style="text-align: center;" required type="text" name="code" id="code" placeholder="Nomor Undangan">
      </div>
      @endif
      @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content=='rsvp')
      <button class="mt-1 button shadowed primary col-md-12 large" type="submit" style="background-color: #82603B;">MASUK</button>
    </form>
  </div>
  @else
  <div style="width: calc(100% - 20px);padding:10px;position: fixed;bottom:0;" class="text-center">
    <button class="mt-1 button primary large" style="width:60%;border-radius: 100px;left:0;bottom: 0;" type="submit">MASUK</button>
    <br>
    <br>
  </div>
</form>
</div>
@endif

@endsection

@section('footer')
<script type="text/javascript">
  @if (\Session::has('message'))
  Metro.dialog.create({
    content: "{!! \Session::get('message') !!}",
    closeButton: true
  });
  @endif
</script>
@endsection