<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollingQuestion extends Model
{
    //
    public function polling()
    {
        return $this->belongsTo('App\Polling');
    }
    protected $fillable = [
        'content', 'polling_id','event_id'
    ];
}
