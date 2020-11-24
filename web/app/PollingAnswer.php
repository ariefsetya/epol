<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollingAnswer extends Model
{
    //
    public function polling()
    {
        return $this->belongsTo('App\Polling')->withDefault();
    }
    
    public function polling_question()
    {
        return $this->belongsTo('App\PollingQuestion')->withDefault();
    }
    protected $fillable = [
        'content', 'polling_question_id', 'polling_id','event_id'
    ];
}
