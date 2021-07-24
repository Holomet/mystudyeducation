<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollageZone extends Model
{
    public function expozone()
    {
    	return $this->belongsTo('App\Models\ExpoZone','expo_zone_id');
    }
}
