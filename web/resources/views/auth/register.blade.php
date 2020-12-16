@extends('layouts.guest')

@section('content')
<div style="text-align: center;margin-top:25%;"> 
  <img src="{{url('images/dbs.png')}}" style="width: 50%;margin: 5% auto;">
  <div class="text-center" style="margin:0 auto;padding: 40px;position: relative;width: 100%;color:white;">
    <form method="POST" action="{{route('register_user')}}">
      {{csrf_field()}}
      <input type="hidden" name="country_id" value="100">
      <input type="hidden" name="event_id" value="{{Session::get('event_id')}}">

      <div>NAME</div>
      <input class="input mb-1" required type="text" name="name" id="name" value="{{ old('name') }}">
      @if ($errors->any())
      @foreach ($errors->get('name') as $error)
      <div>{{ $error }}</div>
      @endforeach
      @endif
      <div>DBS E-MAIL</div>
      <input class="input mb-1" required type="email" name="email" id="email" value="{{ old('email') }}">
      @if ($errors->any())
      @foreach ($errors->get('email') as $error)
      <div>{{ $error }}</div>
      @endforeach
      @endif
      <div>WHATSAPP</div>
      <input class="input mb-1" required type="number" name="phone" id="phone" data-prepend="+62" value="{{ old('phone') }}">
      @if ($errors->any())
      @foreach ($errors->get('phone') as $error)
      <div>{{ $error }}</div>
      @endforeach
      @endif
      <button type="submit" class="button mt-5" style="padding:0px 25px;background-color: #EB2228;color:white;font-family: 'Lato';font-weight: 700;font-size: 17pt;">REGISTER</button>
      <br>
    </form>
  </div>
</div>
@endsection

@section('footer')
<script type="text/javascript">
  $("#name, #email, #phone").on('change',function() {
    if($(this).val()!=""){
      $(this).addClass('filled')
    }else{
      $(this).removeClass('filled')
    }
  })
  if($("#name").val()!=""){
    $("#name").addClass('filled')
  }
  if($("#email").val()!=""){
    $("#email").addClass('filled')
  }
  if($("#phone").val()!=""){
    $("#phone").addClass('filled')
  }
</script>
@endsection