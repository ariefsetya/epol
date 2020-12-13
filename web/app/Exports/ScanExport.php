<?php

namespace App\Exports;

use DB;
use Session;
use Maatwebsite\Excel\Concerns\FromCollection;

class ScanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$data = DB::table('presences')
                ->join('users','users.id','=','presences.user_id')
                ->where(DB::raw('presences.via in ("scan", "search")'))
                ->where('users.event_id',Session::get('event_id'))
                ->groupBy('users.id')
                ->select('users.id', 'users.reg_number', 'users.email', 'users.phone', 'users.name',DB::raw("group_concat(presences.via_info)"), DB::raw('count(users.id)'))
                ->get();

                dd($data);

    	$arr[] = [
    			'Kode',
                'Nama',
                'E-Mail ',
                'Telp ',
                'Scan Info '
    		];
    	foreach ($data as $key) {
                $arr[] = [
        			$key->reg_number,
                    $key->name,
                    $key->email,
                    $key->phone,
        			$key->scan_info
        		];
    	}

        return collect($arr);
    }
}
