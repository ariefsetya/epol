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
      background-color: white;
    }

    table thead, table tbody tr {
      display: table;
      width: 100%;
      table-layout: fixed;
    }
    *{
      font-size: 29pt;
    }
    th{
      color: white !important;
    }
  </style>
</head>
<body style="overflow:hidden;background-color: #2d89ef;">
  <div style="width: 1920px;height:1080px;margin:auto;">
    <div id="background" @if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','quiz_report_background')->exists()) style="border:0px solid #000;width: 1920px;height:1080px;background-image:url({{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','quiz_report_background')->first()->content}});background-position: all;background-repeat: no-repeat; background-size: cover;" @endif>
      <div style="height: 210px"></div>
      <table class="table striped">
        <thead>
          <th class="text-center" style="width:8%">No</th>
          <th class="text-center">E-Mail</th>
          <th class="text-center" style="width:10%">Skor</th>
          <th class="text-center" style="width:15%">Waktu</th>
        </thead>
        <tbody id="data">
          @foreach($report as $key => $row)
          <tr>
            <td class="text-center" style="width:8%">{{$key+=1}}</td>
            <td class="text-center">{{$row['email']}}</td>
            <td class="text-center" style="width:10%">{{$row['polling_response_count']}}</td>
            <td class="text-center" style="width:15%">{{date_format($row['created_at'],"H:i:s")}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
