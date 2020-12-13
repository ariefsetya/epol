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
    	$data = DB::select('SELECT * FROM (select users.id, users.reg_number, users.email, users.phone, users.name,group_concat( concat(presences.created_at," / ",presences.via_info)) as scan_info, count(users.id) from presences join users on users.id = presences.user_id
            where users.event_id='.Session::get('event_id').' and presences.via in ("scan") group by users.id) x ORDER BY scan_info ASC');

        $arr[] = [
         'Kode',
         'Nama',
         'E-Mail ',
         'Telp ',
         'Scan Time ',
         'Scan Via '
     ];
     foreach ($data as $key) {
        $arr[] = [
         $key->reg_number,
         $key->name,
         $key->email,
         $key->phone,
         explode(" / ",explode(",",$key->scan_info)[0])[0],
         explode(" / ",explode(",",$key->scan_info)[0])[1],
     ];
 }

 return collect($arr);
}
}
