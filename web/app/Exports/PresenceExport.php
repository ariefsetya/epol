<?php

namespace App\Exports;

use App\Presence;
use App\User;
use DB;
use Session;
use Maatwebsite\Excel\Concerns\FromCollection;

class PresenceExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$data = Presence::select(DB::raw("id, user_id, min(created_at) as start_time, max(created_at) as end_time"))->where('event_id',Session::get('event_id'))->where('user_id','>',0)->with(['user'])->orderBy('created_at','asc')->groupBy('user_id')->get();

    	$arr[] = [
    			'Kode',
                'Nama',
                'E-Mail ',
                'Telp ',
                'Guest / Quota ',
                'RSVP ',
    			'Log In'
                'Alamat ',
                'Nomor Meja ',
                'Sesi ',
                'Jam ',
    		];
    	foreach ($data as $key) {
    		if($key->user->user_type_id==2){
                $arr[] = [
        			$key->user->reg_number,
                    $key->user->name,
                    $key->user->email,
                    $key->user->phone,
                    ($key->user->rsvp->guest_qty ?? 0) . "/" . $key->user->custom_field_1,
                    $key->user->rsvp->confirm_status ?? '',
        			$key->start_time
                    $key->user->rsvp->address_location ?? '',
                    $key->user->rsvp->session_invitation ?? '',
                    $key->user->rsvp->event_time ?? '',
        		];
            }
    	}

        $data = User::where('event_id',Session::get('event_id'))->where('user_type_id',2)->whereNotIn('id',$data->pluck('user_id'))->get();
        foreach ($data as $key) {
                $arr[] = [
                    $key->reg_number,
                    $key->name,
                    $key->email,
                    $key->phone,
                    ($key->rsvp->guest_qty ?? 0) . "/" . $key->custom_field_1,
                    $key->rsvp->confirm_status ?? '',
                    $key->user->rsvp->confirm_status ?? '',
                    ''
                    $key->user->rsvp->address_location ?? '',
                    $key->user->rsvp->session_invitation ?? '',
                    $key->user->rsvp->event_time ?? '',
                ];
        }

        return collect($arr);
    }
}
