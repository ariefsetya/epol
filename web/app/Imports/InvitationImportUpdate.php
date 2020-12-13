<?php

namespace App\Imports;

use App\User;
use App\RSVP;
use Session;
use Maatwebsite\Excel\Concerns\ToModel;

class InvitationImportUpdate implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!in_array($row[0], ['code','CODE'])){

            if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content == 'rsvp'){
                $user = User::whereRegNumber($row[0])->first();
                if(!$user){
                    $user = new User([
                        'event_id'=>Session::get('event_id'),
                        'country_id'=>100,
                        'user_type_id'=>2,
                        'reg_number'=>uniqid(),
                        'need_login'=>false,
                        'name'=>$row[1] ?? '',
                        'email'=>'',
                        'phone'=>$row[2] ?? '',
                        'company'=>'',
                        'custom_field_1'=>$row[5] ?? '',
                        'custom_field_2'=>$row[3] ?? '',
                        'custom_field_3'=>''
                    ]);
                    $user->save();

                    $rsvp = new RSVP;
                    $rsvp->event_id = Session::get('event_id');
                    $rsvp->user_id = $user->id;
                    $rsvp->seat_number = $row[4] ?? '';
                    $rsvp->session_invitation = $row[5] ?? '';
                    $rsvp->address_location = '';
                    $rsvp->guest_qty = $row[5] ?? '';
                    $rsvp->event_time = $row[6] ?? '';
                    $rsvp->save();
                }else{
                    $user->custom_field_2 = $row[3];
                    $user->save();

                    $rsvp = RSVP::whereUserId($user->id)->first();
                    $rsvp->seat_number = $row[4];
                    $rsvp->session_invitation = $row[6];
                    $rsvp->event_time = $row[7];
                    if($row[5]!=""){
                        $rsvp->guest_qty = $row[5];
                    }
                    $rsvp->save();
                }
            }
        }
    }
}
