@extends('layouts.guest')

@section('content')

<div class="col-md-3 text-center" style="margin:0 auto;">
  <form method="POST" action="{{route('join_quiz',[$polling->id])}}">
    {{csrf_field()}}
    <div class="form-group text-center">
      <label for="name" class="form-control-lg">NAMA</label>
      <input type="text" class="form-control form-control-lg text-center" id="name" name="name" value="{{ old('name') }}" style="text-transform: uppercase;">
      @if($errors->any())
        @foreach ($errors->get('name') as $message)
        <div class="invalid-feedback">
          {{$message}}
        </div>
        @endforeach
      @endif
    </div>
    <div class="form-group text-center">
      <label for="company" class="form-control-lg">NAMA DEALER</label>
      <input type="text" class="form-control form-control-lg text-center" id="company" name="company" value="{{ old('company') }}"style="text-transform: uppercase;">
      @if($errors->any())
        @foreach ($errors->get('company') as $message)
        <div class="invalid-feedback">
          {{$message}}
        </div>
        @endforeach
      @endif
    </div>
    <button type="submit" class="btn btn-primary btn-block btn-lg">SELANJUTNYA</button>
    <br>
  </form>
</div>
<style type="text/css">
  .invalid-feedback{ display: block !important; }
</style>
@endsection
