<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollingParticipant extends Model
{
    //
    protected $casts = [
        'created_at' => 'date:H:i:s',
    ];

    protected $fillable = [
        'event_id', 'user_id', 'polling_id', 'is_winner'
    ];
    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }
    public function polling()
    {
        return $this->belongsTo('App\Polling')->withDefault();
    }
    public function polling_response()
    {
        return $this->belongsTo('App\PollingResponse')->withDefault();
    }
}
