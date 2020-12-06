<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LotteryParticipant extends Model
{
    public function lottery_participant_category()
    {
        return $this->belongsTo('App\LotteryParticipantCategory','category_id');
    }
}
