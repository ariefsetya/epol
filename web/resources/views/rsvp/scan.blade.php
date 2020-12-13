<!DOCTYPE html>
<html style="background-color: #2d89ef;">
<head>
    <title> </title>
    <link rel="stylesheet" type="text/css" href="{{url('css/style.css')}}">
</head>

<body style="overflow:hidden;background-color: #2d89ef;">
    <input class="my-input" id="qrcode" style="opacity: 0;font-size: 1pt;position: absolute;" autofocus>
    <div style="width: 1920px;height:1080px;margin:auto;">
        <div id="background" @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','scan_qr_background')->exists()) style="border:0px solid #000;width: 1920px;height:1080px;background-image:url({{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','scan_qr_background')->first()->content}});background-position: all;background-repeat: no-repeat; background-size: cover;" @endif>
            <div class="main" style="margin-left: 37%;">  
                <h1 id="title" style="margin: 0;padding: 0;">&nbsp;</h1>
                <div id="hadiah" style="font-family:'Verdana';color:cyan;font-size: 30pt;font-weight:bold;margin: 0;padding: 0;text-align: center;width: 100%;">&nbsp;</div>
                <div class=" " style="margin-top:220px;">
                    <div class="countdown agile">
                        <div class="countdown-time agileits_w3layouts" style="color: #333;display: none;" id="guest">
                            <h3 style="font-family: 'Trajan Pro Regular';font-size: 40pt;">Selamat Datang</h3>
                            <div style="height: 40px;"></div>
                            <h3 style="font-family: 'Trajan Pro Bold';font-weight:bold;font-size: 40pt;" id="name"></h3>
                            <div style="height: 40px;"></div>
                            <h3 style="font-family: 'Trajan Pro Regular';font-size: 40pt;" id="seat_number"></h3>
                            <div style="height: 10px;"></div>
                            <h3 style="font-family: 'Trajan Pro Regular';font-size: 40pt;" id="guest_qty"></h3>
                        </div>
                        <div style="font-size: 50pt;padding-top: 100px;" id="idle">
                            <h3 style="font-family: 'Trajan Pro Regular';">Silahkan Scan<br>QR Code Anda</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <iframe name="theFrame" style="border:0;width: 1px;height: 1px;opacity: 0"></iframe>
</body>

<!-- <script src="{{url('vendors/socket.io/socket.io.js')}}"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/3.0.4/socket.io.js"></script>
<script src="{{url('vendors/jquery/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#qrcode").focus();
    })
    document.addEventListener("keypress", function(e) {
        if (e.target.tagName !== "INPUT") {
            var input = document.querySelector(".my-input");
            input.focus();
            input.value = e.key;
            console.log(e.key)
            e.preventDefault();
        }
    });

    var s2 = io("{{env("SOCKET_URL")}}");

    var timeout = "";

    $("#qrcode").on('keypress',function (e) {
        console.log("{{$id}}-"+$(this).val())
        if(e.which == 13) {
            console.log("{{$id}}-"+$(this).val())
            var code = $(this).val();
            $("#qrcode").val('')
            $.ajax({
                url:'{{url('rsvp/checkin')}}/'+code,
                type:'GET',
                dataType:'json',
                success:function(data) {
                    clearTimeout(timeout);
                    popitup('{{url('rsvp/print')}}/'+code+'/Operator {{$id}}');

                    $("#name").html(data.guest.name);
                    $("#seat_number").html("Nomor Meja : "+data.rsvp.seat_number);
                    $("#guest_qty").html("Jumlah Tamu : "+data.rsvp.guest_qty);
                    $("#idle").hide();
                    $("#guest").show();

                    timeout = setTimeout(function(){
                        $("#guest").hide();
                        $("#idle").show();
                    },15000);
                }
            })
            // s2.emit('checkin', "{{$id}}-"+$(this).val(), function(data){
            //     console.log(data)
            //     var guest = data.split("-");
            //     $("#name").html(guest[1]);
            //     $("#seat_number").html("Nomor Meja : "+guest[8]);
            //     $("#idle").hide();
            //     $("#guest").show();
            //     $(this).val('')
            // });
        }
    });

    function popitup(url) {
        window.open(url, "theFrame");
        $("#qrcode").focus();
    }
</script>
</html>
