<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\RSVP;
use App\User;

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
		}
		$rsvp->save();
		$user = User::find(Auth::user()->id);
		if($r->has('email')){
			$user->email = $r->input('email');
		}
		$user->save();

		return redirect(url('/'));
	}
	public function reset()
	{
		$rsvp = RSVP::whereEventId(Session::get('event_id'))->whereUserId(Auth::user()->id)->first();
		$rsvp->confirm_status = 0;
		$rsvp->guest_qty = Auth::user()->custom_field_1;
		$rsvp->save();

		return redirect(url('/'));
	}
}
