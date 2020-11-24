@extends('layouts.guest')

@section('content')
<div class="text-center  col-md-3" style="margin:0 auto;">
  <form class="form-signin" method="post" action="{{route('phoneLogin')}}">
    {{csrf_field()}}

    @if (\Session::has('message'))
    <div class="alert alert-danger">
      {!! \Session::get('message') !!}
    </div>
    @endif
    <br>
    <input type="hidden" name="country_id" value="100">
    <input class="input-large" type="number" name="phone" id="phone" data-role="input" data-prepend="+62" placeholder="Phone Number">
    <hr>
    <button class="button shadowed primary col-md-12 large" type="submit">Check In</button>
  </form>
</div>
@endsection
