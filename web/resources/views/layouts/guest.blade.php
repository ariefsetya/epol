<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height: 100% !important;">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','website_title')->first()->content}}</title>

  <!-- Styles -->
  <link rel="stylesheet" href="{{url('vendors/metro4/css/metro-all.min.css')}}">
  <link rel="stylesheet" href="{{url('css/index.css')}}">
</head>
<body style="position: relative;background-color: white;
@if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','website_background_image')->first())
background-image: url({{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','website_background_image')->first()->content ?? ''}});background-size: 100%;background-repeat: no-repeat;
@endif
min-height: 100% !important;">
<div id="app" style="
  margin: 0 auto;
  max-width: 720px;">
  <main class="py-4">
    @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','website_header_logo')->first())
    <div class="text-center" style="width:30%;margin:0 auto;">
      <div class="">
        <img class="mb-4 text-center" src="{{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','website_header_logo')->first()->content ?? ''}}" alt="" style="width: 100%;">
      </div>
    </div>
    @endif
    @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','website_overlay_background')->first())
    <img style="width:50%;position: absolute;top: 55%;left: 50%;transform: translate(-50%, -50%);" src="{{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','website_overlay_background')->first()->content ?? ''}}"  id="img_overlay_home">
    @endif
    <div style="">
    @yield('content')
    </div>
  </main>
</div>


@if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','website_footer_logo')->first())
<div class="text-center col-md-3" style="margin:0 auto;">
  <img class="mb-4 text-center" src="{{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','website_footer_logo')->first()->content ?? ''}}" alt="" style="width: 60%;">
</div>
@endif
</body>

<script src="{{url('vendors/jquery/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('vendors/metro4/js/metro.min.js')}}"></script>
@yield('footer')
</html>
