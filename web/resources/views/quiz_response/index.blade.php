@extends('layouts.guest')

@section('content')

<div class="col-md-3" style="margin:0 auto;">
    <h4>{{ $polling_question[0]->content }}</h4>
      @foreach($polling_answer as $key)
        <div class="form-check">
          <input style="width: 35px;height: 35px;" onclick="selectdata('{{$polling_question[0]->id}}', '{{$key->id}}')" type="radio" id="customRadio{{$key->id}}" name="customRadio{{$polling_question[0]->id}}" class="form-check-input input-lg">
          <label style="margin-left:10px;" onclick="selectdata('{{$polling_question[0]->id}}', '{{$key->id}}')" class="form-check-label form-control-lg" for="customRadio{{$key->id}}"><strong>{{$key->content}}</strong></label>
        </div>
      @endforeach
      <hr>
    {{$polling_question->render('vendor.pagination.quiz')}}
  <hr>
  <br>
</div>

<!-- Modal -->
<div class="modal fade" id="finishDialog" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        {{$polling->finish_message}}
      </div>
      <div class="modal-footer">
        <a onclick="redirect_home()" class="btn text-white btn-lg btn-primary btn-block">OK</a>
      </div>
    </div>
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
          $(".for_button").removeClass("btn-secondary");
          $(".for_button").addClass("btn-primary");
        }
		});
	}

  function finish_quiz() {
    $("#finishDialog").modal('show');
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
