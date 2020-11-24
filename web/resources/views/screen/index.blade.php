@extends('layouts.app')

@section('content')
<div class="col-md-3" style="margin:0 auto;">
    <h1 class="text-center">Tampilan Layar</h1>
	 <hr>
   <select id="screen" class="form-control form-control-lg">
      <option value="">Pilih Halaman</option>
     @foreach($result as $key => $value)
      <option value="polling:{{$value['polling']->polling_type_id.'-'.$value['polling']->id.'-'.sizeof($value['question']).'-'.$value['question'][0]->id}}">{{$value['polling']->name}}</option>
     @endforeach
      <!-- <option value="custom:product">Produk</option> -->
   </select>
   <hr>
   <div id="question_layout" style="display: none;">
     <select id="question_id"></select>
   </div>
   <hr>

     <span class="btn btn-block btn-primary" onclick="openPage()">Buka di Tab Baru</span>
     <span class="btn btn-block btn-primary" onclick="movePage()">Pindah Halaman</span>
  <br>
</div>


@endsection

@section('footer')
<script type="text/javascript" src="{{url('')}}:9000/socket.io/socket.io.js"></script>
<script type="text/javascript">
  var socket = io("{{url('')}}:9000");
  var url = '';

  $("#screen").on('change',function() {
    var screen = $("#screen").val().split(':');
    if(screen[0]=='polling'){
      var polling = screen[1].split('-');
      if(polling[0]==1){ //polling
        if(polling[2]==1){
          url = '{{route('polling.detail')}}/'+polling[1]+'/'+polling[3];
        }else{
          $.ajax({
            url: "{{route('polling_question')}}/"+polling[1], 
            dataType:'json',
            method:'GET',
            success: function(result){
              var polling_question = result.polling_question
              for (var x = 0; x < polling_question.length; x++) {
                $("#question_id").append('<option value="'+polling_question[x].id+'">'+polling_question[x].content+'</option>');
              }
              if(polling_question>0){
                $("#question_id").on('change',function() {
                  url = '{{route('polling.detail')}}/'+polling[1]+'/'+$("#question_id").val();
                });
              }
            }
          });
        }
      }else if(polling[0]==2){ //question
        alert('belum ada');
      }else if(polling[0]==3){ //quiz
        url = '{{route('quiz_result')}}/'+polling[1];
      }

    }else{
      alert('belum ada');
    }
  });

  function openPage() {
    window.open(url);
  }
  function movePage() {
    socket.emit('screen.change',url);
  }

</script>
@endsection