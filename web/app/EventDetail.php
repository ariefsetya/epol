<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventDetail extends Model
{
    //
    protected $fillable = [
        'event_id', 'name', 'type', 'content', 'choices'
    ];
}
