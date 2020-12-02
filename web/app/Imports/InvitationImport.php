<?php

namespace App\Imports;

use App\User;
use App\RSVP;
use Session;
use Maatwebsite\Excel\Concerns\ToModel;

class InvitationImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!in_array($row[0], ['code','NAMA'])){

            if(in_array(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content, ['register_barcode','polling_website']){
                $user = new User([
                    'event_id'=>Session::get('event_id'),
                    'country_id'=>100,
                    'user_type_id'=>2,
                    'reg_number'=>$row[0],
                    'need_login'=>false,
                    'name'=>$row[1],
                    'email'=>$row[2],
                    'phone'=>$row[3],
                    'company'=>$row[4],
                    'custom_field_1'=>$row[5],
                    'custom_field_2'=>$row[6],
                    'custom_field_3'=>$row[7]
                ]);
                $user->save();
            }
            if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content == 'rsvp'){
                $user = new User([
                    'event_id'=>Session::get('event_id'),
                    'country_id'=>100,
                    'user_type_id'=>2,
                    'reg_number'=>uniqid(),
                    'need_login'=>false,
                    'name'=>$row[0] ?? '',
                    'email'=>$row[2] ?? '',
                    'phone'=>$row[1] ?? '',
                    'company'=>'',
                    'custom_field_1'=>$row[4] ?? '',
                    'custom_field_2'=>'',
                    'custom_field_3'=>''
                ]);
                $user->save();

                $rsvp = new RSVP;
                $rsvp->event_id = Session::get('event_id');
                $rsvp->user_id = $user->id;
                $rsvp->seat_number = $row[5] ?? '';
                $rsvp->session_invitation = $row[6] ?? '';
                $rsvp->address_location = $row[3] ?? '';
                $rsvp->guest_qty = $row[4] ?? '';
                $rsvp->event_time = $row[7] ?? '';
                $rsvp->save();
            }
        }
    }
}
