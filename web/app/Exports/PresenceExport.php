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
    			'Perusahaan ',
                'Tempat Lahir ',
                'Tanggal Lahir ',
    			'Check In'
    		];
    	foreach ($data as $key) {
    		if($key->user->user_type_id==2){
                $arr[] = [
        			$key->user->reg_number,
                    $key->user->name,
                    $key->user->email,
                    $key->invitation->phone,
        			$key->invitation->company,
                    $key->invitation->custom_field_1,
                    $key->invitation->custom_field_2,
        			$key->start_time
        		];
            }
    	}


        $data = User::where('event_id',Session::get('event_id'))->where('user_type_id',2)->whereNotIn('id',array_values($data->toArray()))->get();

        foreach ($data as $key) {
                $arr[] = [
                    $key->reg_number,
                    $key->name,
                    $key->email,
                    $key->phone,
                    $key->company,
                    $key->custom_field_1,
                    $key->custom_field_2,
                    ''
                ];
        }

        return collect($arr);
    }
}
