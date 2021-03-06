<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\RSVP;
use App\Presence;
use DB;
use App\User;
use App\Exports\ScanExport;
use Maatwebsite\Excel\Facades\Excel;

class RSVPController extends Controller
{
	public function confirm(Request $r)
	{
		$rsvp = RSVP::whereEventId(Session::get('event_id'))->whereUserId(Auth::user()->id)->first();
		if($r->submit == 'yes'){
			$rsvp->confirm_status = 1;
		}else{
			$rsvp->confirm_status = 2;
		}
		$rsvp->guest_qty = $r->input('guest_qty') ?? $rsvp->guest_qty;
		$rsvp->save();

		return redirect(url('/'));
	}
	public function update(Request $r)
	{
		$rsvp = RSVP::whereEventId(Session::get('event_id'))->whereUserId(Auth::user()->id)->first();
		if($r->has('address_location')){
			$rsvp->address_location = $r->input('address_location');
			$rsvp->confirm_status = 3;
		}
		$rsvp->save();
		$user = User::find(Auth::user()->id);
		if($r->has('email')){
			$user->email = $r->input('email');
		}
		$user->save();

		if($r->has('email')){
			return redirect()->route('sendEmailBarcode');
		}else{
			return redirect(url('/'));
		}
	}
	public function reset()
	{
		$rsvp = RSVP::whereEventId(Session::get('event_id'))->whereUserId(Auth::user()->id)->first();
		$rsvp->confirm_status = 0;
		$rsvp->guest_qty = Auth::user()->custom_field_1;
		$rsvp->save();

		return redirect(url('/'));
	}
	public function scan($id)
	{
		$data['id'] = $id;
		return view('rsvp.scan')->with($data);
	}
	public function print($id, $info)
	{
		$data['guest'] = User::whereRegNumber($id)->first();
		
		$p = new Presence;
		$p->event_id = Session::get('event_id');
		$p->user_id = $data['guest']->id;
		$p->via = 'scan';
		$p->via_info = $info;
		$p->save();

		return view('rsvp.print')->with($data);
	}
	public function print_qr($id)
	{
		$data['guest'] = User::whereRegNumber($id)->first();
		
		$p = new Presence;
		$p->event_id = Session::get('event_id');
		$p->user_id = $data['guest']->id;
		$p->via = 'search';
		$p->via_info = 'Helpdesk';
		$p->save();

		return view('rsvp.print_qr')->with($data);
	}
	public function helpdesk()
	{
		return view('rsvp.helpdesk');
	}
	public function checkin($id)
	{
		$data['guest'] = User::whereRegNumber($id)->first();
		$data['rsvp'] = User::whereRegNumber($id)->first()->rsvp;
		return response()->json($data);
	}
	public function search($param)
	{
		$data = User::where('event_id',Session::get('event_id'))->where('phone','like','%'.$param.'%')->orWhere('name','like','%'.$param.'%')->where('event_id',Session::get('event_id'))->orWhere('email','like','%'.$param.'%')->where('event_id',Session::get('event_id'))->get();
		$arr = [];
		foreach ($data as $key) {
			$arr[] = ['name'=>$key->name,'phone'=>$key->phone,'email'=>$key->email,'reg_number'=>$key->reg_number, 'id'=>$key->id, 'seat_number'=>$key->rsvp->seat_number ?? '', 'session_invitation'=>$key->rsvp->session_invitation ?? ''];
		}
		return response()->json($arr);
	}

	public function seat($session = "")
	{
		$data = [];
		$data['session'] = RSVP::select(DB::raw('session_invitation, count(id) as jumlah'))->where('event_id',Session::get('event_id'))->groupBy('session_invitation')->get();
		if($session <> ""){
			$data['result']['seat'] = RSVP::select(DB::raw('seat_number, count(id) as jumlah'))->where('event_id',Session::get('event_id'))->where('session_invitation',$session)->groupBy('seat_number')->orderBy(DB::raw('length(seat_number), seat_number'))->get();
			$data['result']['session'] = $session;
		}else{
			$data['result'] = false;
		}
		return view('rsvp.seat')->with($data);
	}

    public function report()
    {
        $x = new ScanExport;
        $data['scan'] = $x->collection();

        return view('rsvp.report')->with($data);
    }
    public function export_excel()
    {
        return Excel::download(new ScanExport, 'laporan_scan_qr.xlsx');
    }
}
