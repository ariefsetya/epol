<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height: 100% !important;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','website_title')->first()->content}}</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.min.css') }}">
    <style type="text/css">
        @page { margin: 0px !important; }
        body { margin: 0px !important; }
    </style>
</head>
<body @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','website_background_image')->first()) style="position: relative;background-image: url({{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','website_background_image')->first()->content}});background-size: 100%;min-height: 100% !important;" @endif>
    <div id="app">
        <main class="py-4">

            <div class="text-center" style="margin:0 auto;">

                <div style="width:90%; margin:0 auto;position: relative;display: block;clear: both;">
                    <br>
                    @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','website_header_logo')->first())
                    <img class="mb-4 text-center" src="{{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','website_header_logo')->first()->content}}" alt="" style="width: 30%;margin:0 auto;">
                    @endif
                    <br>
                    <br>
                    <h2 style="color:white;margin:0 auto;text-align: center;font-family: sans-serif;">{{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','barcode_success_message')->first()->content}}</h2>
                    <br>
                    <br>
                    <br>
                    <div style="width:50%; margin:0 auto;">
                        <div style="background: white;padding:20px;">
                            <img style="width: 100%" src="{{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','barcode_url')->first()->content.Auth::user()->reg_number}}">
                        </div>
                    </div>
                    <br>
                    <br>
                    @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content=='register_barcode')
                    <br>
                    <div style="display: block;color: white;width:70%;margin:0 auto;">Please save and scan the QR Code<br>at registration desk on venue</div>
                    <br>
                    @endif
                    @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content=='rsvp')
                    <br>
                    <div style="text-align:center;display: block;color: black;width:100%;margin:0 auto;padding:10px; background: rgba(255,255,255,0.4);">  
                        <b>{{Auth::user()->name}}</b><br>
                        Acara : {{Auth::user()->rsvp->session_invitation}}<br>           
                        Waktu : {{Auth::user()->rsvp->event_time}}<br>           
                        Nomor Meja : {{Auth::user()->rsvp->seat_number}}<br>           
                        Undangan : {{Auth::user()->rsvp->guest_qty}} orang<br>  
                        <ul style="font-size:9pt;list-style-position:outside;text-align: left;">
                            <li>Mohon tunjukkan QR Code di meja registrasi pada hari acara</li>
                            <li>Anda dapat menyimpan QR Code di gallery HP Anda atau kirim ke email Anda dengan klik salah satu tombol berikut</li>
                        </ul>
                    </div>
                    <br>
                    @endif
                    @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','website_footer_logo')->first())
                    <br>
                    <br>
                    <div style="width:50%; margin:0 auto;">
                        <div style="">
                            <img style="width: 100%" src="{{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','website_footer_logo')->first()->content}}">
                        </div>
                    </div>
                    @endif
                </div>
            </div>

        </main>
    </div>
</body>
</html>
