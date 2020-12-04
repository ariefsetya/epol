<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LotteryProperty extends Model
{
    protected $fillable = [
        'event_id', 'name', 'report_image_url', 'display_image_url'
    ];
}
