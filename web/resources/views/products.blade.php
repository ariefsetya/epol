@extends('layouts.guest')

@section('content')
<style type="text/css">
  /* Center the loader */
  .loader {
    display: block;
    z-index: 1;
    width: 150px;
    height: 150px;
    margin: 20px auto 20px;
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
  }

  @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  /* Add animation to "page content" */
  .animate-bottom {
    position: relative;
    -webkit-animation-name: animatebottom;
    -webkit-animation-duration: 1s;
    animation-name: animatebottom;
    animation-duration: 1s
  }

  @-webkit-keyframes animatebottom {
    from { bottom:-100px; opacity:0 } 
    to { bottom:0px; opacity:1 }
  }

  @keyframes animatebottom { 
    from{ bottom:-100px; opacity:0 } 
    to{ bottom:0; opacity:1 }
  }
</style>

<div class="col-md-4 animate-bottom" id="myDiv" style="margin:0 auto;">
  <div class="">
    <img class="mb-4 text-center" src="{{asset('img/HEADER.png')}}" alt="" style="width: 100%;">
  </div>
	@if(File::exists('img/PRODUCTS/'.$type.'/'.$code.'/'.$code.'.png') and File::exists('img/PRODUCTS/'.$type.'/'.$code.'/FEATURES.png'))
  <div class="loader" id="loader1"></div>
  <div class="col-md-12" id="layout_img_1" style="display:none">
    <img class="img-fluid" id="image1" src="{{asset('img/PRODUCTS/'.$type.'/'.$code.'/'.$code.'.png')}}">
  </div>
  <div class="loader" id="loader2"></div>
  <div class="col-md-12" id="layout_img_2" style="display:none">
    <img class="img-fluid" id="image2" src="{{asset('img/PRODUCTS/'.$type.'/'.$code.'/FEATURES.png')}}">
  </div>
  @elseif(File::exists('img/PRODUCTS/'.$type.'/'.$code.'/'.$code.'-1.png') and File::exists('img/PRODUCTS/'.$type.'/'.$code.'/'.$code.'-2.png'))
  <div class="loader" id="loader1"></div>
  <div class="col-md-12" id="layout_img_1" style="display:none">
    <img class="img-fluid" id="image1" src="{{asset('img/PRODUCTS/'.$type.'/'.$code.'/'.$code.'-1.png')}}">
  </div>
  <div class="loader" id="loader2"></div>
  <div class="col-md-12" id="layout_img_2" style="display:none">
    <img class="img-fluid" id="image2" src="{{asset('img/PRODUCTS/'.$type.'/'.$code.'/'.$code.'-2.png')}}">
  </div>
  @else
  <div class="loader" id="loader1"></div>
  <div class="col-md-12" id="layout_img_1" style="display:none">
    <img class="img-fluid" id="image1" src="{{asset('img/PRODUCTS/'.$type.'/'.$code.'/'.$code.'.png')}}">
  </div>
  @endif
  <hr>

  <div style="display: none;" id="layout_vote">
  @if(!Session::has($code))
  <div id="vote" class="text-center">
  <h3>Do you like this product?</h3>
  <div class="text-center">
  <span class="btn btn-success btn-lg" onclick="selectresponse(1)">Yes</span>
  <span class="btn btn-danger btn-lg" onclick="selectresponse(0)">No</span>
  </div>
  </div>
  <hr>
  <br>
  @else
  <div id="vote" class="text-center">
  <h3>Thanks for your vote!</h3>
  </div>
  <hr>
  <br>
  @endif
  </div>
</div>
@endsection

@section('footer')
	@if(!Session::has($code))
		<script type="text/javascript">
			function selectresponse(response_id) {
				$.ajax({
				  	url: "{{route('response_product')}}/"+'{{$code}}'+'/'+response_id, 
				  	dataType:'json',
				  	method:'GET',
				  	success: function(result){
				  		$("#vote").html('<h4>Thanks for your vote!</h4>');
					}
				});
			}
		</script>
  @endif
  <script type="text/javascript">
      $('#image1').on('load', function(){
        $('#loader1').hide();
        $("#layout_img_1").fadeIn();
        $("#layout_vote").fadeIn();
      });
      $('#image2').on('load', function(){
        $('#loader2').hide();
        $("#layout_img_2").fadeIn();
      });
  </script>
@endsection