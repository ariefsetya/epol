<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LotteryHistory extends Model
{
    public function lottery_participant()
    {
        return $this->belongsTo('App\LotteryParticipant')->withDefault();
    }
}
