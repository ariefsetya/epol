<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use \App\LotteryHistory;
use DB;

class ScanHistoryExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$data = LotteryHistory::get();

    	$arr[] = [
            'Category',
            'Kode Undangan',
            'Nama Dealer',
            'Kota',
            'Status',
            'Waktu',
    		];

        foreach ($data as $key) {
            $arr[] = [
                $key->lottery_participant->lottery_participant_category->name,
                $key->lottery_participant->number,
                $key->lottery_participant->name,
                $key->lottery_participant->city,
                $key->status?'WIN':'LOSS',
                $key->created_at,
            ];
        }

        return collect($arr);
    }
}
