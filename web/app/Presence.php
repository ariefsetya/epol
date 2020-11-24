<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }
}
