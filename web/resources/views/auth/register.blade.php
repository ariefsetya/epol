@extends('layouts.guest')

@section('content')

<div class="col-md-3 text-center" style="margin:0 auto;">
  <form method="POST" action="{{route('register_user')}}">
    {{csrf_field()}}
    <input type="hidden" name="country_id" value="100">
    <input type="hidden" name="event_id" value="{{Session::get('event_id')}}">
    <div class="form-group text-center">
      <input type="text" required placeholder="name" class="form-control form-control-lg text-center" id="name" name="name" value="{{ old('name') }}">
      @if($errors->any())
        @foreach ($errors->get('name') as $message)
        <div class="invalid-feedback">
          {{$message}}
        </div>
        @endforeach
      @endif
    </div>
    <div class="form-group text-center">
      <input type="text" required placeholder="company" class="form-control form-control-lg text-center" id="company" name="company" value="{{ old('company') }}">
      @if($errors->any())
        @foreach ($errors->get('company') as $message)
        <div class="invalid-feedback">
          {{$message}}
        </div>
        @endforeach
      @endif
    </div>
    <div class="form-group text-center">
      <input type="text" required placeholder="phone number" class="form-control form-control-lg text-center" id="phone" name="phone" value="{{ old('phone') }}">
      @if($errors->any())
        @foreach ($errors->get('phone') as $message)
        <div class="invalid-feedback">
          {{$message}}
        </div>
        @endforeach
      @endif
    </div>
    <div class="form-group text-center">
      <input type="email" required placeholder="email" class="form-control form-control-lg text-center" id="email" name="email" value="{{ old('email') }}">
      @if($errors->any())
        @foreach ($errors->get('email') as $message)
        <div class="invalid-feedback">
          {{$message}}
        </div>
        @endforeach
      @endif
    </div>
    <div class="row">
    <div class="col-md-6 form-group text-center">
      <input type="text" required placeholder="place of birth" class="form-control form-control-lg text-center" id="custom_field_1" name="custom_field_1" value="{{ old('custom_field_1') }}">
      @if($errors->any())
        @foreach ($errors->get('custom_field_1') as $message)
        <div class="invalid-feedback">
          {{$message}}
        </div>
        @endforeach
      @endif
    </div>
    <div class="col-md-6 form-group text-center">
      <input type="date" required placeholder="custom_field_2" class="form-control form-control-lg text-center" id="custom_field_2" name="custom_field_2" value="{{ old('custom_field_2')!=''?old('custom_field_2'):'1970-01-01' }}">
      @if($errors->any())
        @foreach ($errors->get('custom_field_2') as $message)
        <div class="invalid-feedback">
          {{$message}}
        </div>
        @endforeach
      @endif
    </div>
    </div>
    <button type="submit" class="btn btn-block btn-lg" style="background:yellow;">SUBMIT</button>
    <br>
  </form>
</div>
<style type="text/css">
  .invalid-feedback{ display: block !important; }
</style>
@endsection

@section('footer')
    <script type="text/javascript">
        
    $("input[type=date]").datepicker({ dateFormat: "MM/dd/yyyy" });
    </script>
@endsection