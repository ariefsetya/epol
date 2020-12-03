@extends('layout-single')

@section('content')

<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
    <a class="app-bar-item c-pointer" href="{{url('/core')}}">
        <span class="mif-home fg-white"></span>
    </a>
</div>
<div class="p-4">
    <h2>Setting</h2>
    <a href="{{url('/setting/reset_presence')}}" class="shortcut">
        <span class="caption">Reset Presence</span>
        <span class="mif-rocket icon"></span>
    </a>
    <a href="{{url('/setting/reset_polling')}}" class="shortcut">
        <span class="caption">Reset Polling</span>
        <span class="mif-rocket icon"></span>
    </a>
    <a href="{{url('/setting/reset_quiz')}}" class="shortcut">
        <span class="caption">Reset Quiz</span>
        <span class="mif-rocket icon"></span>
    </a>
    <a href="{{url('/setting/reset_lottery')}}" class="shortcut">
        <span class="caption">Reset Lottery</span>
        <span class="mif-rocket icon"></span>
    </a>
</div>
@endsection
