@extends('layout-single')

@section('content')

<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
    <a class="app-bar-item c-pointer" href="{{url('/core')}}">
        <span class="mif-home fg-white"></span>
    </a>
</div>
<div class="p-4">
    <div class="place-right">
        <a class="button" href="{{route('lottery_property.create')}}">Tambah</a>
    </div>
    <h2>Data Lottery Property</h2>
    <table class="table striped row-hover table-border">
     <thead>
      <tr>
       <th class="text-center">Nama</th>
       <th class="text-center">Display Image</th>
       <th class="text-center">Report Image</th>
       <th colspan="2" class="text-center">Action</th>
   </tr>
</thead>
<tbody>
  @foreach($lottery_property as $key)
  <tr>
    <td>{{$key->name}}</td>
    <td>{{$key->display_image_url}}</td>
    <td>{{$key->report_image_url}}</td>
    <td class="text-center"><a class="button warning" href="{{route('lottery_property.edit',[$key->id])}}">Edit</a></td>
    <td class="text-center"><form method="POST" action="{{route('lottery_property.destroy',[$key->id])}}">{{csrf_field()}}<input type="hidden" name="_method" value="DELETE">
     <button type="submit" class="button alert">Delete</button></form></td>
 </tr>
 @endforeach
</tbody>
</table>
</div>
@endsection
