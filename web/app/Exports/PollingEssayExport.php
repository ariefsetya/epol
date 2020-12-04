<?php

namespace App\Exports;

use App\Polling;
use App\PollingResponse;
use App\PollingAnswer;
use App\User;
use DB;
use Session;
use Maatwebsite\Excel\Concerns\FromCollection;

class PollingEssayExport implements FromCollection
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id; 
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $polling = Polling::find($this->id);
        $polling_response = PollingResponse::where('event_id',Session::get('event_id'))->where('polling_id',$this->id)->get();

    	$arr[] = [
    			'Kode Undangan ',
                'Nama Dealer ',
                'Kota ',
                'Jawaban ',
                'Essay ',
                'Waktu '
    		];
    	foreach ($polling_response as $key) {
    		if($key->user->user_type_id==2){
                $var = [
        			$key->user->reg_number,
                    $key->user->name,
                    $key->user->company,
        		];
                $d = json_decode($key->answer_text);
                $ans = "";
                foreach ($d->check as $row) {
                    $ans .= PollingAnswer::find($row)->content."\n";
                }
                array_push($var, $ans);
                array_push($var, $d->essay);
                array_push($var, $key->created_at);
                $arr[] = $var;
            }
    	}

        return collect($arr);
    }
}
