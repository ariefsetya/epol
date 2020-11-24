{{csrf_field()}}
<input type="hidden" name="event_id" value="{{Session::get('event_id')}}">
<div class="form-group">
  <input type="text" data-role="input" data-prepend="Nama" required name="name" id="name" placeholder="Nama" value="{{$event_detail->name ?? ''}}">
</div>
@if($event_detail->type=='text')
<div class="form-group">
  <input type="text" data-role="input" data-prepend="Content" required name="content" id="content" placeholder="Isi" value="{{$event_detail->content ?? ''}}">
</div>
@elseif($event_detail->type=='image')
<div class="form-group">
  <input type="file" class="form-control" data-role="file" data-prepend="Isi" required name="content" id="content" placeholder="Isi">
  <img src="{{$event_detail->content ?? ''}}" class="img-fluid">
</div>
@else
<h2>Not Supported Data Type</h2>
@endif
<hr>
<button type="submit" class="button primary">Submit</button>