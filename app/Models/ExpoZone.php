<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpoZone extends Model
{
    public function country()
    {
    	return $this->belongsTo('App\Models\Country','country_id');
    }
}
