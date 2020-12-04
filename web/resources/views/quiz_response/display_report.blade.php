<!DOCTYPE html>
<html>
<head>
    <title> </title>
    <link rel="stylesheet" type="text/css" href="{{url('css/metro.css')}}">
    <style type="text/css">

        table tbody {
          display: block;
          max-height: 785px;
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
        <div id="background" @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','lottery_report_background')->exists()) style="border:0px solid #000;width: 1920px;height:1080px;background-image:url({{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','quiz_report_background')->first()->content}});background-position: all;background-repeat: no-repeat; background-size: cover;" @endif>
            <div style="height: 200px"></div>
            <table class="table striped">
                <thead>
                    <th class="text-center" style="width:8%">No</th>
                    <th class="text-center">Nama Dealer</th>
                    <th class="text-center" style="width:30%">Kota</th>
                    <th class="text-center">Skor</th>
                    <th class="text-center">Waktu</th>
                </thead>
                <tbody id="data">
                  @foreach($report as $key => $row)
                  <tr>
                    <td class="text-center"  style="width:8%">{{$key+=1}}</td>
                    <td class="text-center" >{{$row->user->name}}</td>
                    <td class="text-center"  style="width:30%">{{$row->user->company}}</td>
                    <td class="text-center" >{{$row->polling_response_count}}</td>
                    <td class="text-center" >{{date_format($row->created_at,"H:i:s")}}</td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>