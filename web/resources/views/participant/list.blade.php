@extends('layout-single')

@section('content')

<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
	<a class="app-bar-item c-pointer" href="{{url('/')}}">
		<span class="mif-home fg-white"></span>
	</a>
</div>
<div class="p-4">
	<div class="col-md-2 place-right"><input id="upload_csv" type="file" data-role="file" data-button-title="<span class='mif-folder'></span>" data-prepend="Upload CSV"></div>
	<h2>Participant Data</h2>
	<table class="table striped row-hover table-border"
	data-role="table"
	data-rows="10"
	data-rownum="true"
	data-cls-table-top="row"
	data-cls-search="col-md-10"
	data-cls-rows-count="col-md-2"
	data-source="{{env('SOCKET_URL'). '/table_data/participant/list'}}"
	data-pagination="true"
	data-show-all-pages="true"></table>
</div>

@endsection

@section('footer')

<script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
<script type="text/javascript">
	$('#upload_csv').change(function(ev) {
		if(confirm('Apakah Anda yakin ingin mengupload data?')){
			upload();
		}
	});

	async function upload() {
		let file = document.getElementById("upload_csv").files[0];
		let formData = new FormData();

		formData.append("f", file);
		formData.append("cid", 1);
		formData.append("_token", "{{csrf_token()}}");
		try {
			let r = await fetch("{{url('/upload/csv')}}", {method: "POST", body: formData})
			.then(response => response.json())
			.then(async data => {
				try {
					let x = await fetch("{{env('DATA_URL').'data/csv_insert.php?f='}}" + data.filename, {method: "GET"});
					console.log(x);
				}catch(e){
					console.log('error 1:', e);

				}
			}); 
		} catch(e) {
			console.log('error:', e);
		}
	}

/*	var s2 = io("{{env("SOCKET_URL")}}");

	$("#qrcode").on('keypress',function (e) {
		if(e.which == 13) {
			s2.emit('scan-'+$("#category_id").val(), $(this).val(), function(data){
				console.log(data)
				var result = data.split("-");
				$('#number').val(result[0]);
				$('#name').val(result[1]);
				$('#city').val(result[2]);
				// s2.emit('data', data);
			});
			$(this).val('')
		}
	});
	*/
</script>
@endsection