<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollageCourse extends Model
{
    public function collage()
    {
    	return $this->belongsTo('App\Models\Collage','collage_id');
    }

    public function course()
    {
    	return $this->belongsTo('App\Models\Course','course_id');
    }
}
