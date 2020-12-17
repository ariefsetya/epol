@extends('layouts.guest')

@section('content')
<div class="" style="margin-top:0 auto;color: white;padding: 10px">
	<div style="margin-top:25%; @if($polling->polling_type_id==6) text-align: center; @endif">
		
		<h4>{!! $polling_question[0]->content !!}</h4>
		<br>
		@foreach($polling_answer as $key)
		<div class="form-check" @if($polling->polling_type_id==6) style="display:inline-block;width: 49%;" @endif>
			@if($polling->polling_type_id==6)
			<div style="padding: 5px;text-align: center;">
				<label style="color:white" class="form-check-label form-control-lg" for="customRadio{{$key->id}}"><strong>{{$key->content}}</strong></label>
				<img src="https://cf.shopee.co.id/file/1740a66d75c848b38c85ade20a2505e2" style="width: 100%;">
				<input style="width: 35px;height: 35px;" onclick="selectdata('{{$polling_question[0]->id}}', '{{$key->id}}')" type="radio" id="customRadio{{$key->id}}" name="customRadio{{$polling_question[0]->id}}" class="form-check-input input-lg">
			</div>
			@elseif($polling->polling_type_id==5)
			<input style="width: 35px;height: 35px;" onclick="selectdata('{{$polling_question[0]->id}}', '{{$key->id}}')" type="checkbox" id="customRadio{{$key->id}}" data-value="{{$key->id}}" name="customRadio{{$polling_question[0]->id}}[]" class="form-check-input input-lg">
			@else
			<input style="width: 35px;height: 35px;" onclick="selectdata('{{$polling_question[0]->id}}', '{{$key->id}}')" type="radio" id="customRadio{{$key->id}}" name="customRadio{{$polling_question[0]->id}}" class="form-check-input input-lg">
			@endif
			@if($polling->polling_type_id<>6)
			<label style="margin-left:10px;vertical-align: super !important;" onclick="selectdata('{{$polling_question[0]->id}}', '{{$key->id}}')" class="form-check-label form-control-lg" for="customRadio{{$key->id}}"><strong style="vertical-align: super !important;">{{$key->content}}</strong></label>
			@endif
		</div>
		@endforeach
		@if($polling->polling_type_id==5)
		<label>Alasan (minimal 10 karakter)</label>
		<textarea id="reason" onkeyup="selectdata(0,1)" rows="3"></textarea>
		@endif
		
		<br>
		{{$polling_question->render()}}
		<br>
		<br>
	</div>
</div>
@endsection

@section('footer')
<script type="text/javascript">
	$('textarea').each(function () {
		this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
	}).on('input', function () {
		this.style.height = 'auto';
		this.style.height = (this.scrollHeight) + 'px';
	});
	@if($polling->polling_type_id==5)

	function selectdata(x,i) {
		var flag = 0;
		$("input[type=checkbox]:checked").each(function( index, value ) {
			flag ++;
		});
		if (flag >= 3 && $("#reason").val().trim().length>=10) {
			$(".for_button").removeClass("disabled");
			$(".for_button").removeClass("secondary");
			$(".for_button").css("background-color","#EB2228");
		}else{
			$(".for_button").css("background-color","#eee");
			$(".for_button").addClass("disabled secondary");
		}
	}

	function finish_polling() {
		var checked = [];
		$("input[type=checkbox]:checked").each(function( index, value ) {
			checked.push(value.dataset.value);
		});
		console.log(checked)
		$.ajax({
			url: "{{route('save_checkbox_essay')}}", 
			dataType:'json',
			data:{
				_token:'{{csrf_token()}}',
				check:checked,
				essay:$("#reason").val(),
				question_id:'{{$polling_question[0]->id}}'
			},
			method:'POST',
			success: function(result){
				Metro.dialog.create({
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
		});
	}
	@else
	function selectdata(question_id, answer_id) {
		$.ajax({
			url: "{{route('select_polling_response')}}/"+question_id+'/'+answer_id, 
			dataType:'json',
			method:'GET',
			success: function(result){
				$(".for_button").removeClass("disabled");
				$(".for_button").removeClass("secondary");
				$(".for_button").css("background-color","#EB2228");
			}
		});
	}
	function finish_polling() {
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
	@endif
</script>
@endsection
