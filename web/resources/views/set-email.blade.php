
@extends('layouts.guest')

@section('content')

<div class="text-center" style="margin:100% auto 0;padding: 10px; background: rgba(255,255,255,0.4);">
    @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content=='rsvp')

    @if(Auth::user()->rsvp->confirm_status == 1)

    @if(Auth::user()->email == '')
    <div style="">

        Silahkan konfirmasi alamat email Anda
        <form method="POST" action="{{url('/rsvp/update')}}">
            {{csrf_field()}}
            <input type="email" name="email" data-role="input" data-prepend="Email" required value="{{Auth::user()->email}}">
            <hr>
            <button class="button primary" style="width: 100%;background-color: #82603B;" type="submit" name="submit">KIRIM</button>
            <a class="mt-1 button" style="width: 100%" href="{{url('/')}}">KEMBALI</a>
        </form>
    </div>
    @endif

    @endif

    @endif
</div>

@endsection