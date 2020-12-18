@extends('layouts.guest')

@section('content')
<div style="text-align: center;margin-top:25%;"> 
  <img src="{{url('images/dbs.png')}}" style="width: 50%;margin: 5% auto;">
  <div class="text-center" style="margin:0 auto;padding: 40px;position: relative;width: 100%;color:white;">
    <form method="POST" action="{{route($route)}}">
      {{csrf_field()}}
      <input type="hidden" name="country_id" value="100">
      <input type="hidden" name="event_id" value="{{Session::get('event_id')}}">
      <input type="hidden" name="next" value="{{$next}}">

      <div>DBS E-MAIL</div>
      <input class="input mb-1" required type="email" name="email" id="email" value="{{ old('email') }}">
      @if ($errors->any())
      @foreach ($errors->get('email') as $error)
      <div>{{ $error }}</div>
      @endforeach
      @endif
      <button type="submit" class="button mt-5" style="padding:0px 25px;background-color: #EB2228;color:white;font-family: 'Lato';font-weight: 700;font-size: 17pt;">LOGIN</button>
      <br>
    </form>
  </div>
</div>
@endsection

@section('footer')
<script type="text/javascript">
  $("#email").on('change',function() {
    if($(this).val()!=""){
      $(this).addClass('filled')
    }else{
      $(this).removeClass('filled')
    }
  })
  if($("#email").val()!=""){
    $("#email").addClass('filled')
  }
</script>
@endsection