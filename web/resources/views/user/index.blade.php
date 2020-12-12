@extends('layout-single')

@section('content')
<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
    <a class="app-bar-item c-pointer" href="{{url('/core')}}">
        <span class="mif-home fg-white"></span>
    </a>
</div>
<div class="p-4">
    <h2>Data Tamu
        <div class="float-right">
            <a class="button success" href="{{route('user.import')}}">Import</a>
            <a class="button primary" href="{{route('user.create')}}">Tambah</a>
            <a class="button alert" onclick="return confirm('Apakah Anda yakin ingin me-reset data?')" href="{{route('user.reset')}}">Reset</a>
        </div>
    </h2>
    <table class="table for_datatables">
    	<thead>
    		<tr>
               <th>Nomor Induk</th>
               <th>Nama</th>
               <th>Nomor Meja</th>
               <th>Email</th>
               <th>Nomor HP</th>
               <th>Perusahaan</th>
               <th>Edit</th>
               <th>Delete</th>
               <th>Session</th>
           </tr>
       </thead>
       <tbody>
          @foreach($user as $key)
          <tr>
            <td>{{$key->reg_number}}</td>
            <td>{{$key->name}}</td>
            <td>{{$key->rsvp->seat_number ?? ''}}</td>
            <td>{{$key->email}}</td>
            <td>+{{$key->country->phonecode."  ".$key->phone}}</td>
            <td>{{$key->company}}</td>
            <td><a class="button warning" href="{{route('user.edit',[$key->id])}}">Edit</a></td>
            <td>
                <form method="POST" action="{{route('user.destroy',[$key->id])}}">{{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="button alert">Delete</button>
                </form>
            </td>
            <td><a class="button alert" href="{{route('user.clear',[$key->id])}}">Clear</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
