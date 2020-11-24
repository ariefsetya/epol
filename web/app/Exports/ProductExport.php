<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use \App\ProductResponse;
use \App\Product;
use \App\Presence;
use DB;

class ProductExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$data = Product::all();

    	$arr[] = [
    			'Code',
    			'Yes',
    			'No',
                'Abstain',
                'Vote',
    			'Visitor',
    		];

        foreach ($data as $key) {
            $yes = sizeof(\App\ProductResponse::where('product_id',$key->id)->where('response_id',1)->get());
            $no = sizeof(\App\ProductResponse::where('product_id',$key->id)->where('response_id',0)->get());
            $visitor = sizeof(\App\Presence::where('product_id',$key->id)->groupBy('uuid')->get());
            $arr[] = [
                'code'=>$key->code,
                'yes'=>$yes,
                'no'=>$no,
                'abstain'=>($visitor-($yes+$no)),
                'vote'=>$yes+$no,
                'visit'=>$visitor
            ];
        }

        return collect($arr);
    }
}
