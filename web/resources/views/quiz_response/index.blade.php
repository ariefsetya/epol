@extends('layouts.guest')

@section('content')

<div class="col-md-3" style="margin:0 auto;">
  <div style="margin-top:20%;">
    <h4>{{ $polling_question[0]->content }}</h4>
    @foreach($polling_answer as $key)
    <div class="form-check">
      <input style="width: 35px;height: 35px;" onclick="selectdata('{{$polling_question[0]->id}}', '{{$key->id}}')" type="radio" id="customRadio{{$key->id}}" name="customRadio{{$polling_question[0]->id}}" class="form-check-input input-lg">
      <label style="margin-left:10px;vertical-align: super !important;" onclick="selectdata('{{$polling_question[0]->id}}', '{{$key->id}}')" class="form-check-label form-control-lg" for="customRadio{{$key->id}}"><strong style="vertical-align: super !important;">{{$key->content}}</strong></label>
    </div>
    @endforeach
    <hr>
    {{$polling_question->render('vendor.pagination.quiz')}}
    <hr>
    <br>
  </div>
</div>

@endsection

@section('footer')
<script type="text/javascript" src="{{url('')}}:9000/socket.io/socket.io.js"></script>
<script type="text/javascript">
  var winner = [];
  var socket = io("{{url('')}}:9000");
  function selectdata(question_id, answer_id) {
    $.ajax({
     url: "{{route('select_quiz_response')}}/"+question_id+'/'+answer_id, 
     dataType:'json',
     method:'GET',
     success: function(result){
      winner = result;

      $(".for_button").removeClass("disabled");
      $(".for_button").removeClass("secondary");
      $(".for_button").addClass("primary");
    }
  });
  }

  function finish_quiz() {
    Metro.dialog.create({
      title: "Informasi",
      content: '{{$polling->finish_message}}',
      actions: [
      {
        caption: "OK",
        cls: "primary large col-md-12",
        onclick: function(){
          window.location='{{route('home')}}';
        }
      }
      ]
    });
  }
  function redirect_home() {
    if(winner.win){
      socket.emit('quiz',winner);
      window.location = '{{route('removeRedirectToHome')}}';
    }else{
      window.location = '{{route('removeRedirectToHome')}}';
    }
  }

  preventBack();
  function preventBack(){window.history.forward();}
  setTimeout("preventBack()", 0);
  window.onunload=function(){null};
</script>
@endsection
