
@extends('layouts.guest')

@section('content')


<div class="text-center col-md-3" style="margin:0 auto;">
    @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content=='rsvp')

    @if((Auth::user()->rsvp->confirm_status ?? 0) == 0)
    <form method="POST" action="{{url('/rsvp/confirm')}}">
        {{csrf_field()}}
        Halo, {{Auth::user()->name}},<br>
        Terima Kasih telah melakukan RSVP<br>
        Acara : AKAD NIKAH<br>
        Pukul : 10.00 WIB - selesai<br>
        Nomor Meja : 19<br>
        Undangan : @if(Auth::user()->custom_field_1 > 1) <select name="guest_qty" style="background:rgba(0,0,0,0); border-top:0;border-left:0;border-right: 0; width: 35px;clear: none;display: inline;">@for($i=1;$i<=Auth::user()->custom_field_1;$i++) <option value="{{$i}}" @if(Auth::user()->custom_field_1==$i) selected @endif>{{$i}}</option> @endfor</select> @else 1 @endif orang
        <br>
        <br>
        <br>
        Mohon klik salah satu tombol dibawah ini
        <br>
        <div>
            <div>
                <button name="submit" type="submit" value="yes" class="button primary" style="width: 100%">Ya, saya akan hadir</button>
            </div>
            <div class="mt-2">
                <button name="submit" type="submit" value="no" class="button" style="width: 100%">Maaf, saya tidak dapat hadir</button>
            </div>
        </div>
    </form>
    @endif

    @if(Auth::user()->rsvp->confirm_status == 1)

    @if(Auth::user()->email == '')
    Silahkan lengkapi data Anda
    <form method="POST" action="{{url('/rsvp/update')}}">
        {{csrf_field()}}
        <input type="email" name="email" data-role="input" data-prepend="Email" required>
        <hr>
        <button class="button primary" style="width: 100%" type="submit" name="submit">Update</button>
        <br>
        <a class="button" style="width: 100%" href="{{url('/rsvp/reset')}}">Kembali</a>
    </form>
    @endif

    @endif

    @if(Auth::user()->rsvp->confirm_status == 2)

    @if(Auth::user()->rsvp->address_location == '')
    Mohon menginformasikan alamat Anda, kami akan mengirimkan Souvenir
    <form method="POST" action="{{url('/rsvp/update')}}">
        {{csrf_field()}}
        <input type="text" name="address_location" required data-role="input" data-prepend="Alamat" value="{{Auth::user()->rsvp->address_location}}">
        <hr>
        <button class="button primary" style="width: 100%" type="submit" name="submit">Update</button>
        <br>
        <a class="button" style="width: 100%" href="{{url('/rsvp/reset')}}">Kembali</a>
    </form>
    @endif

    @endif

    @endif
    @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content=='register_barcode')


    @if($message = Session::get('success'))
    <p class="text-center" style="color:white;">{{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','barcode_email_sent_message')->first()->content}}</p>
    @endif

    @elseif(in_array(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content,['polling_website','register_face']))
    <h3>{{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','greeting_text')->first()->content}}
        @if(Auth::check())
        <br>
        {{Auth::user()->name}}<br>
        {{Auth::user()->company}}
        @endif
    </h3>
    @endif

    @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content=='register_face')
    @if(Auth::check())
    @if(Auth::user()->custom_field_3=='')
    <a class="btn btn-lg btn-primary text-white col-md-12" href="{{route('user.register_face')}}">SELANJUTNYA</a>
    @endif
    @endif
    @endif

    @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','idle')->first()->content==0)
    @foreach(\App\Polling::where('event_id',Session::get('event_id'))->get() as $row)
    @if($row->polling_type_id==3)
    @if(Auth::check())
    @if(\App\PollingResponse::where('event_id',Session::get('event_id'))->where('user_id',Auth::user()->id)->count()==\App\PollingQuestion::where('event_id',Session::get('event_id'))->where('polling_id',$row->id)->count())
    <a class="btn btn-lg btn-secondary text-white col-md-12">{{$row->name}}</a>
    @else
    <a href="{{route('quiz_response',[$row->id])}}" class="btn btn-lg btn-dark col-md-12">{{$row->name}}</a>
    @endif
    @else
    <a href="{{route('quiz_join',[$row->id])}}" class="btn btn-lg btn-dark col-md-12">{{$row->name}}</a>
    @endif
    @else
    @if(\Session::has('polling_'.$row->id))
    <a class="btn btn-lg btn-secondary text-white col-md-12">{{$row->name}}</a>
    @else
    <a href="{{route('polling_response',[$row->id])}}" class="btn btn-lg btn-dark col-md-12">{{$row->name}}</a>
    @endif
    @endif
    <hr>
    @endforeach
    @else
    <h2>Please scan again later</h2>
    @endif
    
    @if(in_array(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content, ['register_barcode', 'rsvp']))
    @if(!Auth::check())
    <div style="display: block;" id="overlay_home"></div>
    <a id="button_register" style="display:none;background: yellow; color: black;" href="{{route('registerPage')}}" class="btn btn-lg col-md-12">REGISTER</a>
    @else
    @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content=='register_barcode' or (\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content=='rsvp' and Auth::user()->rsvp->confirm_status == 1 and Auth::user()->email != ''))
    <div style="width:100%; margin:0 auto;position: relative;display: block;clear: both;">
        <h5 style="color:white">{{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','barcode_success_message')->first()->content}}</h5>
        <br>
        <div style="width:50%; margin:0 auto;">
            <div style="background: white;padding:10px;">
                <img style="width: 100%" src="{{url('barcode/'.Auth::user()->reg_number.'.png')}}">
            </div>
        </div>
        @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content=='register_barcode')
        <br>
        <div style="display: block;color: white;width:70%;margin:0 auto;">Please save and scan the QR Code<br>at registration desk on venue</div>
        <br>
        @endif
        @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content=='rsvp')
        <br>
        <div style="display: block;color: black;width:100%;margin:0 auto;padding:10px; background: rgba(255,255,255,0.4);">  
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
        <div style="display: block;">
            <a class="button primary"  href="{{route('downloadBarcode')}}" style="width: 100%">SIMPAN</a>
            <a class="button primary mt-3"  href="{{route('sendEmailBarcode')}}" style="width: 100%">KIRIM EMAIL</a>
        </div>
    </div>
    @endif
    @endif
    @endif

    @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','logout_button_visibility')->first()->content==1)
    @if(Auth::check())
    @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content=='register_barcode' or (\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content=='rsvp' and Auth::user()->rsvp->confirm_status == 1 and Auth::user()->email != ''))
    <br>
    <br>
    <a href="{{route('logout')}}" class="button" style="width: 100%">SELESAI</a>
    @endif
    @endif
    @endif
</div>
@endsection

@section('footer')
@if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content=='register_barcode')
@if(!Auth::check())
<script type="text/javascript">
    $(window).ready(function() {
        $("#overlay_home").css('height',$("#img_overlay_home").height()+40);
        $("#button_register").fadeIn();
    });
</script>
@endif
@endif

@endsection