@extends('layouts.guest')

@section('content')
<div class="col-md-3" style="margin:0 auto;">
    <div class="text-center">
      <img class="mb-4" src="{{asset('img/HEADER.png')}}" alt="" style="width: 60%;">
    </div>
    <h4>{{ $polling_question[0]->content }}</h4>
	@foreach($polling_answer as $key)
		<div class="form-check">
		  <input style="width: 35px;height: 35px;" onclick="selectdata('{{$polling_question[0]->id}}', '{{$key->id}}')" type="radio" id="customRadio{{$key->id}}" name="customRadio{{$polling_question[0]->id}}" class="form-check-input input-lg">
		  <label style="margin-left:10px;" onclick="selectdata('{{$polling_question[0]->id}}', '{{$key->id}}')" class="form-check-label form-control-lg" for="customRadio{{$key->id}}"><strong>{{$key->content}}</strong></label>
		</div>
	@endforeach
	<hr>
    {{$polling_question->render()}}
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
        <a href="{{route('home')}}" class="btn btn-dark btn-block">OK</a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	function selectdata(question_id, answer_id) {
		$.ajax({
		  	url: "{{route('select_polling_response')}}/"+question_id+'/'+answer_id, 
		  	dataType:'json',
		  	method:'GET',
		  	success: function(result){
		  		$(".for_button").removeClass("disabled");
		  		$(".for_button").removeClass("btn-secondary");
		  		$(".for_button").addClass("btn-dark");
			}
		});
	}
</script>
@endsection
