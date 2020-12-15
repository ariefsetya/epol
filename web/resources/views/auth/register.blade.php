@extends('layouts.guest')

@section('content')

<div class="text-center" style="margin:0 auto;">
  <form method="POST" action="{{route('register_user')}}">
    {{csrf_field()}}
    <input type="hidden" name="country_id" value="100">
    <input type="hidden" name="event_id" value="{{Session::get('event_id')}}">

    <input class="input-large" required type="text" name="name" id="name" data-role="input" data-prepend="+62" placeholder="Nama Lengkap" value="{{ old('name') }}">
    <input class="input-large" required type="email" name="email" id="email" data-role="input" data-prepend="+62" placeholder="Email" value="{{ old('email') }}">
    <input class="input-large" required type="number" name="phone" id="phone" data-role="input" data-prepend="+62" placeholder="Nomor WhatsApp" value="{{ old('phone') }}">
    <button type="submit" class="button col-md-12 large">SUBMIT</button>
    <br>
  </form>
</div>
@endsection