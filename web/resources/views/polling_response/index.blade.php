@extends('layouts.guest')

@section('content')
<div class="" style="margin-top:0 auto;color: white;padding: 20px">
	<div style="margin-top:25%; @if($polling->polling_type_id==6) text-align: center; @endif">
		
		<h4>{!! $polling_question[0]->content !!}</h4>
		<br>
		@foreach($polling_answer as $key)
		<div class="form-check" @if($polling->polling_type_id==6) style="display:inline-block;width: 49%;" @endif>
			@if($polling->polling_type_id==6)
			<div style="text-align: center;" class="mb-2 parent_box_vote"  id="voteImageParent{{$key->id}}">
				<div onclick="selectdata('{{$polling_question[0]->id}}', '{{$key->id}}')"  id="voteImage{{$key->id}}" class="box_vote" style="opacity:0;font-size:100pt;font-weight:bold;position: absolute;width: 100%;height: 100%;border: 10px solid #EB2228;color:#EB2228;">
					<div style="padding-top: 30px;">✓</div>
				</div>
				<br>
				<label id="labelImage{{$key->id}}" style="color:white;font-size: 15pt;" class="form-check-label form-control-lg label_image" for="customRadio{{$key->id}}"><strong>{{$key->content}}</strong></label>
				<img src="{{$key->image_url}}" style="width: 100%;" onclick="selectdata('{{$polling_question[0]->id}}', '{{$key->id}}')" >
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
		@if(in_array($polling->polling_type_id,[5,6]))
		<div>
			
		<label>Alasan (minimal 10 karakter)</label>
		<textarea id="reason" onkeyup="validate_input()" rows="3"></textarea>
		</div>
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
	@if($polling->polling_type_id==6)
	var questionId = 0;
	var selectedImage = 0;
	function selectdata(x,i) {
		selectedImage = i
		questionId = x
		$(".box_vote").css('opacity','0');
		$(".parent_box_vote").css('background-color','');
		$(".label_image").css('color','white');
		$("#voteImage"+i).css('opacity','1');
		$("#voteImageParent"+i).css('background-color','white');
		$("#labelImage"+i).css('color','black');
		validate_input();
	}

	function validate_input() {
		
		if (selectedImage > 0 && $("#reason").val().trim().length>=10) {
			$(".for_button").removeClass("disabled");
			$(".for_button").removeClass("secondary");
			$(".for_button").css("background-color","#EB2228");
		}else{
			$(".for_button").css("background-color","#eee");
			$(".for_button").addClass("disabled secondary");
		}
	}

	function finish_polling() {
		console.log()
		$.ajax({
			url: "{{route('save_vote_essay')}}", 
			dataType:'json',
			data:{
				_token:'{{csrf_token()}}',
				answer_id:selectedImage,
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
	@elseif($polling->polling_type_id==5)

	function selectdata(x,i) {
		validate_input();
	}


	function validate_input() {
		
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
