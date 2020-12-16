@extends('layouts.guest')

@section('content')

<div class="" style="margin:0 auto;color: white;padding: 10px;">
  <div style="margin-top:25%;">
    <h4>{{ $polling_question[0]->content }}</h4>
    @foreach($polling_answer as $key)
    <div class="form-check">
      <input style="width: 35px;height: 35px;" onclick="selectdata('{{$polling_question[0]->id}}', '{{$key->id}}')" type="radio" id="customRadio{{$key->id}}" name="customRadio{{$polling_question[0]->id}}" class="form-check-input input-lg">
      <label style="margin-left:10px;vertical-align: super !important;" onclick="selectdata('{{$polling_question[0]->id}}', '{{$key->id}}')" class="form-check-label form-control-lg" for="customRadio{{$key->id}}"><strong style="vertical-align: super !important;">{{$key->content}}</strong></label>
    </div>
    @endforeach
    {{$polling_question->render('vendor.pagination.quiz')}}
  </div>
</div>

@endsection

@section('footer')
<script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
<script type="text/javascript">
  var winner = [];
  var socket = io("{{env("SOCKET_URL")}}");
  function selectdata(question_id, answer_id) {
    $.ajax({
     url: "{{route('select_quiz_response')}}/"+question_id+'/'+answer_id, 
     dataType:'json',
     method:'GET',
     success: function(result){
      winner = result;

      $(".for_button").removeClass("disabled");
      $(".for_button").removeClass("secondary");
      $(".for_button").css("background-color","#EB2228");
    }
  });
  }

  function finish_quiz() {
    if(winner.win){
      socket.emit('quiz',winner.user);
    }
    window.location='{{route('finish_quiz',$polling->id)}}';
  }

  preventBack();
  function preventBack(){window.history.forward();}
  setTimeout("preventBack()", 0);
  window.onunload=function(){null};
</script>
@endsection
