@extends('layouts.guest')

@section('content')
<div class="" style="margin:0 auto;overflow: hidden;">
    <h1 class="text-center" style="text-transform: uppercase;font-size:120px;font-weight: bold;">{{$polling->name}} Winners</h1>
    <br>
    <br>
    <div class="row">
      <?php 
      function ordinal($number) {
          $ends = array('th','st','nd','rd','th','th','th','th','th','th');
          if ((($number % 100) >= 11) && (($number%100) <= 13))
              return $number. '<sup>th</sup>';
          else
              return $number. "<sup>".$ends[$number % 10]."</sup>";
      }
      ?>
    @for($i=0;$i<$polling->max_winner;$i++)
    <div id="winner_box_{{$i}}" class="text-center col-md-6" style="display: none;">
      <h2 style="font-size:80px;text-transform: uppercase;font-weight: bold;">{!! ordinal($polling->max_winner>0?($i+1):0) !!} Winner</h2>
      <h3 id="name_{{$i}}" style="font-size:100px;text-transform: uppercase;font-weight: 400;"></h3>
      <h3 id="company_{{$i}}" style="font-size:90px;text-transform: uppercase;font-weight: 400;"></h3>
      <h5 id="created_at_{{$i}}" style="font-size:60px;text-transform: uppercase;font-weight: 400;"></h5>
    </div>
   @endfor
   </div>
  <br>
</div>


@endsection

@section('footer')
<script type="text/javascript" src="{{url('')}}:9000/socket.io/socket.io.js"></script>
<script type="text/javascript">
  var socket = io("{{url('')}}:9000");
  get_winner();
  socket.on('quiz',function(msg) {
      get_winner();
  });
  socket.on('screen.change',function(msg) {
    $("body").fadeOut(500);
    setTimeout(function () {
      window.location = msg
    },500);
  });

  function get_winner() {
    $.ajax({
        url: "{{route('quiz_result_data',[$polling->id])}}", 
        dataType:'json',
        method:'GET',
        success: function(result){
          var participant = result.polling_participant;
          for (var x = 0; x < participant.length; x++) {
            $("#name_"+x).html(participant[x].user.name);
            $("#company_"+x).html(participant[x].user.company);
            $("#created_at_"+x).html("ANSWER TIME: "+participant[x].created_at);
            $("#winner_box_"+x).fadeIn();
          }
      }
    });
  }
</script>
@endsection