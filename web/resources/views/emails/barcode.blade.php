Dear {{Auth::user()->name}},<br>
<br>
{{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','barcode_email_body')->first()->content}}