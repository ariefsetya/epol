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
                    <th class="text-center">No</th>
                    <th class="text-center">Kode</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Kota</th>
                </thead>
                <tbody id="data">
                    <tr>
                        <td class="text-center">1</td>
                        <td class="text-center">0002</td>
                        <td class="text-center">CV</td>
                        <td class="text-center">JAKARTA</td>
                    </tr>
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
            html += "<tr><td class='text-center'>"+(winner.length - i + 1)+"</td><td class='text-center'>"+winner[i][0]+"</td><td class='text-center'>"+winner[i][1]+"</td><td class='text-center'>"+winner[i][2]+"</td>";
        }
        $("#data").html(html);

        // $('#code').html(data[0]);
        // $('#name').html(data[1]);
        // $('#city').html(data[2]);
    });
</script>
</html>
