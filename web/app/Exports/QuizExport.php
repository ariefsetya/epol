<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Polling;
use App\PollingQuestion;
use App\PollingParticipant;
use App\PollingResponse;

class QuizExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $id;

    public function __construct($id)
    {
        $this->id = $id; 
    }

    public function collection()
    {

        $data['polling'] = Polling::where('event_id',Session::get('event_id'))->whereId($this->id);
        $data['polling_participant'] = PollingParticipant::with(['user'])->where('event_id',Session::get('event_id'))->where('polling_id',$this->id)->get();

    	$data = PollingParticipant::where('event_id',Session::get('event_id'))->with(['user'])->where('polling_id',$this->id)->get();

    	$var = [
    		'Nama',
	    	'Dealer'
	    	];

        foreach(\App\PollingQuestion::where('event_id',Session::get('event_id'))->where('polling_id',$this->id)->get() as $key => $val){
			array_push($var,'Pertanyaan '.($key+1));
        }

		array_push($var,'Total');
		array_push($var,'Waktu');
		array_push($var,'Status');

    	$arr[] = $var;
    	foreach ($data as $key) {
        $x = 0;

		$var = [
			$key->user->name,
			$key->user->company
    	];

        foreach(\App\PollingQuestion::where('event_id',Session::get('event_id'))->where('polling_id',$this->id)->get() as $row => $val){
	        $win = isset(\App\PollingResponse::where('event_id',Session::get('event_id'))->where('polling_id',$this->id)->where('user_id',$key->user->id)->where('polling_question_id',$val->id)->first()->is_winner)?\App\PollingResponse::where('event_id',Session::get('event_id'))->where('polling_id',$this->id)->where('user_id',$key->user->id)->where('polling_question_id',$val->id)->first()->is_winner:0;
	        array_push($var, $win==1?'Benar':'Salah');
	        $x+= $win;
        }

		array_push($var,$x);
		array_push($var,date_format(date_create($key->created_at),"H:i:s"));
		array_push($var,$key->is_winner==1?'Menang':'Tidak Menang');
    		
    	$arr[] = $var;

    	}

        return collect($arr);

    }
}
