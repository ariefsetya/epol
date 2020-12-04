<!DOCTYPE html>
<html>
<head>
    <title> </title>
    <link rel="stylesheet" type="text/css" href="{{url('css/metro.css')}}">
    <style type="text/css">

        table tbody {
          display: block;
          max-height: 635px;
          overflow-y: scroll;
      }

      table thead, table tbody tr {
          display: table;
          width: 100%;
          table-layout: fixed;
      }
      *{
        font-size: 35pt;
    }
</style>
</head>
<body style="overflow:hidden;background-color: #2d89ef;">
    <div style="width: 1920px;height:1080px;margin:auto;">
        <div id="background" @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','lottery_report_background')->exists()) style="border:0px solid #000;width: 1920px;height:1080px;background-image:url({{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','lottery_report_background')->first()->content}});background-position: all;background-repeat: no-repeat; background-size: cover;" @endif>
            <div style="height: 350px"></div>
            <table class="table striped">
                <thead>
                    <th class="text-center" style="width:8%">No</th>
                    <th class="text-center" style="width:10%">Kupon</th>
                    <th class="text-center">Nama Dealer</th>
                    <th class="text-center" style="width:30%">Kota</th>
                </thead>
                <tbody id="data">
                </tbody>
            </table>
        </div>
    </div>
</body>

<script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.js"></script>
<script type="text/javascript">

    var s2 = io("{{env("SOCKET_URL")}}");
    var winner = [];

    s2.on('display', function(msg){
        console.log(msg)
        var data = msg.split("-")
        winner.push(data); 
        $("#data").html('');
        var html;
        for (var i = winner.length - 1; i >= 0; i--) {
            html += "<tr><td class='text-center' style='width:8%'>"+(winner.length - i)+"</td><td class='text-center' style='width:10%'>"+winner[i][0]+"</td><td class='text-center'>"+winner[i][1]+"</td><td class='text-center' style='width:30%'>"+winner[i][2]+"</td>";
        }
        $("#data").html(html);

        // $('#code').html(data[0]);
        // $('#name').html(data[1]);
        // $('#city').html(data[2]);
    });
    s2.on('display_image', function(msg){
        console.log(msg)
        var data = msg.split("|") 
        $('#background').css('background-image','url('+data[1]+')');
    });
</script>
</html>
