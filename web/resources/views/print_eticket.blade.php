<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height: 100% !important;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','website_title')->first()->content}}</title>

    <!-- Styles -->
    <style type="text/css">

        @font-face {
            font-family: 'Lato';
            font-style: normal;
            font-weight: normal;
            src: url('{{url('/fonts/lato-v14-latin-ext_latin-700.woff')}}') format('woff');
        }
        @page { margin: 0px !important; }
        body { margin: 0px !important; }
        .page-break {page-break-after: always;}
        *{font-family: 'Lato' !important;}

    </style>
</head>
<body>
    @if(false)
    <div @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','eticket_background_image')->exists()) style="position: relative;background-image: url({{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','eticket_background_image')->first()->content}});background-size: 100%;min-height: 100% !important;width:1000px;height:1497px;" @endif>
        <div style="position: absolute;bottom:0;width: 100%;font-family: 'Lato';font-size: 20pt;padding: 10px;">
            <div style="padding: 5px;font-size: 25pt;">{{Auth::user()->name}}</div>
            <div style="padding: 5px;">{{Auth::user()->email}}</div>
            <div style="padding: 5px;">{{Auth::user()->phone}}</div>
            <div style="padding: 5px;">Order Info</div>
            <div style="padding: 5px 5px 10px;">No #INV{{str_replace([":","-"," "],"",Auth::user()->created_at)}}. by <i>{{Auth::user()->name}}</i></div>
            <span style="margin: 10px 5px;border: 2px solid #000;padding: 5px;">{{Auth::user()->reg_number}}</span>
            <br>
            <br>
        </div>
    </div>
    <div class="page-break"></div>
    @endif
    <div @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','eticket_background_image_qr')->exists()) style="position: relative;background-image: url({{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','eticket_background_image_qr')->first()->content}});background-size: 100%;min-height: 100% !important;width:1000px;height:1497px;" @endif>
        <div style="text-align: center;color: white;padding-top: 350px;font-size: 18pt;">
            <img src="{{url('images/e4.png')}}" style="height: 35px;">
            <br>
            <br>
            <div>As a first time participant using DBS laptop,<br>you must follow this One Time Webex Setup guide prior to the event.<br>This will install Webex Meeting App from DBS Software<br>Centre for optimal streaming experience!</div><br><br><div>On the day of the event, click on this hyperlink:</div><br>
            <div style="text-align: center;"><a style="text-decoration: none;" href="https://dbs.webex.com/dbs/onstage/g.php?MTID=eadfc61710aea7d42d633412f4db7637d"><img src="{{url('images/download.png')}}" style="height: 35px"></a></div>
            <br><br><div style="font-family: 'Lato' !important;">Enter your First Name, Last Name, Email Address and<br>click on [Join Now]</div><br><br>
            <img src="{{url('images/e5.png')}}" style="height: 35px;">
            <br>
            <br>
            <div>Download Webex Meeting App<br>from Apple App Store or Google PlayStore<br>Click on Join Meeting & Input Meeting Number:<br>
            <span style="color:yellow;">176 070 7355</span><br>Input Password: <span style="color:yellow;">App2020</span></div>
        </div>
        <div style="position: absolute;bottom:0;width: 100%;font-family: 'Lato';font-size: 20pt;padding: 10px;">

            <div style="display: inline-block;width: 230px">
                <div>Virtual Photobooth</div>
                <img src="{{url('images/qrcode.jpeg')}}" style="width: 230px;">
            </div>
            <div style="display: inline-block;margin-left: 20px;">
                <div style="padding: 5px;font-size: 25pt;">{{Auth::user()->name}}</div>
                <div style="padding: 5px;">{{Auth::user()->email}}</div>
                <div style="padding: 5px;">{{Auth::user()->phone}}</div>
                <div style="padding: 5px;">Order Info</div>
                <div style="padding: 5px 5px 10px;">No #INV{{str_replace([":","-"," "],"",Auth::user()->created_at)}}. by <i>{{Auth::user()->name}}</i></div>
                <span style="margin: 10px 5px;border: 2px solid #000;padding: 5px;">{{Auth::user()->reg_number}}</span>
                <br>
                <br>
            </div>
        </div>
    </div>
</body>
</html>
