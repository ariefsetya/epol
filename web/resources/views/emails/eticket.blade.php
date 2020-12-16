Dear {{Auth::user()->name}},<br>
<br>
{{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','eticket_email_body')->first()->content}}