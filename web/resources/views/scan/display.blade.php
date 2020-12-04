<!DOCTYPE html>
<html>
<head>
    <title> </title>
    <link rel="stylesheet" type="text/css" href="{{url('css/style.css')}}">
</head>
<body style="overflow:hidden;background-color: #2d89ef;">
    <div style="width: 1920px;height:1080px;margin:auto;">
        <div id="background" @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','lottery_display_background')->exists()) style="border:0px solid #000;width: 1920px;height:1080px;background-image:url({{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','lottery_display_background')->first()->content}});background-position: all;background-repeat: no-repeat; background-size: cover;" @endif>
            <div class="main" >  
                <h1 id="title" style="margin: 0;padding: 0;">&nbsp;</h1>
                <div id="hadiah" style="font-family:'Verdana';color:cyan;font-size: 30pt;font-weight:bold;margin: 0;padding: 0;text-align: center;width: 100%;">&nbsp;</div>
                <div class=" " style="margin-top:320px;">
                    <div class="countdown agile">
                        <div class="countdown-time agileits_w3layouts" style="color: #333;">
                            <ul class="clearfix w3_agileits" id="js-countDown" style="color: #333;">
                                <li class=""><i class="" id="code" style="font-size: 120px;color:black;font-weight:bold;font-family:Tahoma;">XXXXXXXXX</i></li>
                            </ul>
                        </div>
                    </div>
                    <center>
                        <div class="agileits_newsletter" style="margin-top: 50px">
                            <div id="terpilih">
                                <h1 id="name" style="font-size: 60px;color:black;font-weight:bold;font-family:Segoe UI;"></h1>
                                <h3 id="city" style="font-size: 40px;color:black;font-weight:normal;font-family:Segoe UI;"></h3>
                            </div>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.js"></script>
<script type="text/javascript">

    var s2 = io("{{env("SOCKET_URL")}}");

    s2.on('display', function(msg){
        console.log(msg)
        var data = msg.split("-") 
        $('#code').html(data[0]);
        $('#name').html(data[1]);
        $('#city').html(data[2]);
    });
    s2.on('display_image', function(msg){
        console.log(msg)
        var data = msg.split("|") 
        $('#background').css('background-image','url('+data[0]+')');
    });
</script>
</html>
