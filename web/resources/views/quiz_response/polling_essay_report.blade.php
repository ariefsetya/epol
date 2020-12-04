@extends('layout-single')

@section('content')

<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
    <a class="app-bar-item c-pointer" href="{{url('/core')}}">
        <span class="mif-home fg-white"></span>
    </a>
</div>
<div class="p-4">
    <h2>Laporan {{$polling->name}}
        <a class="btn btn-primary float-right" href="{{route('polling_essay.export_excel',[$polling->id])}}">Export</a></h2>
        <table class="table for_datatables">
           <thead>
              <tr>
                 <th>Kode Undangan</th>
                 <th>Nama Dealer</th>
                 <th>Kota</th>
                 <th>Pertanyaan</th>
                 <th>Essay</th>
                 <th>Waktu</th>
             </tr>
         </thead>
         <tbody>
          @foreach($polling_response as $key)
          <tr>
            <td>{{$key->user->reg_number}}</td>
            <td>{{$key->user->name}}</td>
            <td>{{$key->user->company}}</td>
            <?php $win = json_decode($key->answer_text);?>
            <td>
                @foreach($win->check as $row)
                {{\App\PollingAnswer::find($row)->content}}<br>
                @endforeach

            </td>
            <td>
                {{$win->essay ?? ''}}
            </td>
            <td>{{$key->created_at}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
