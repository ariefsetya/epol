@extends('layouts.guest')

@section('content')

<div class="text-center" style="margin:0 auto;">
  <form method="POST" action="{{route('register_user')}}">
    {{csrf_field()}}
    <input type="hidden" name="country_id" value="100">
    <input type="hidden" name="event_id" value="{{Session::get('event_id')}}">

    @if ($errors->any())
    <div class="info-box alert" style="width: 100%; height: auto; visibility: visible;">
      <div class="info-box-content">
        <ul style="list-style-type: none;">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      <span class="button square closer"></span>
    </div>
    @endif
    <input class="input-large mb-1" required type="text" name="name" id="name" data-role="input" placeholder="Nama Lengkap" value="{{ old('name') }}">
    <input class="input-large mb-1" required type="email" name="email" id="email" data-role="input" placeholder="Email" value="{{ old('email') }}">
    <input class="input-large mb-1" required type="number" name="phone" id="phone" data-role="input" data-prepend="+62" placeholder="Nomor WhatsApp" value="{{ old('phone') }}">
    <button type="submit" class="button col-md-12 large primary">DAFTAR</button>
    <br>
  </form>
</div>
@endsection