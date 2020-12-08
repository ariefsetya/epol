<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RSVP extends Model
{
    protected $fillable = [
        'seat_number', 'session_invitation','guest_qty','event_time'
    ];
}
