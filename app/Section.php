<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
     public function sectionsDescription()
	{
	    return $this->hasMany('App\SectionsDescription', 'sections_id');
	}
}
