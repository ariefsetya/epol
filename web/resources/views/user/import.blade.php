@extends('layout-single')

@section('content')
<div class="app-bar pos-absolute bg-blue z-1" data-role="appbar">
	<a class="app-bar-item c-pointer" href="{{url('/admin/user')}}">
		<span class="mif-arrow-left fg-white"></span>
	</a>
</div>
<div class="p-4">

	<h2>Import Data Tamu</h2>
	<form method="POST" enctype="multipart/form-data" action="{{route('user.process_import')}}">
		{{csrf_field()}}

		<div class="form-group">
			<label for="import_type">Jenis Import</label>
			<select type="text" class="form-control" required name="import_type" id="import_type" placeholder="Jenis Import">
				<option value="1">Import</option>
				<option value="2">Hapus &amp; Import</option>
			</select>
		</div>
		<div class="form-group">
			<label for="excel_file">File Excel</label>
			<input type="file" data-role="file" class="form-control" required name="excel_file" id="excel_file" placeholder="File Excel">
		</div>
		<hr>
		<button type="submit" class="button primary">Submit</button>
	</form>

	<h2>Update Data Tamu</h2>
	<form method="POST" enctype="multipart/form-data" action="{{route('user.process_import_update')}}">
		{{csrf_field()}}

		<div class="form-group">
			<label for="excel_file">File Excel</label>
			<input type="file" data-role="file" class="form-control" required name="excel_file" id="excel_file" placeholder="File Excel">
		</div>
		<hr>
		<button type="submit" class="button primary">Submit</button>
	</form>

</div>
@endsection
