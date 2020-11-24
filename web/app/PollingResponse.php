<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollingResponse extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }
    public function polling()
    {
        return $this->belongsTo('App\Polling')->withDefault();
    }
    public function polling_answer()
    {
        return $this->belongsTo('App\PollingAnswer')->withDefault();
    }
    
    public function polling_question()
    {
        return $this->belongsTo('App\PollingQuestion')->withDefault();
    }
}
