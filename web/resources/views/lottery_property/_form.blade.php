{{csrf_field()}}
<input type="hidden" name="event_id" value="{{Session::get('event_id')}}">
<div class="form-group">
  <input type="text" data-role="input" data-prepend="Nama" required name="name" id="name" placeholder="Nama" value="{{$lottery_property->name ?? ''}}">
</div>
<div class="form-group">
  <input type="file" class="form-control" data-role="file" data-prepend="Display Image" required name="display_image_url" id="display_image_url" placeholder="Display Image">
  <img src="{{$lottery_property->display_image_url ?? ''}}" class="img-fluid">
</div>
<div class="form-group">
  <input type="file" class="form-control" data-role="file" data-prepend="Report Image" required name="report_image_url" id="report_image_url" placeholder="Report Image">
  <img src="{{$lottery_property->report_image_url ?? ''}}" class="img-fluid">
</div>
<hr>
<button type="submit" class="button primary">Submit</button>