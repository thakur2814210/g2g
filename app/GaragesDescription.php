<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class GaragesDescription extends Authenticatable
{
    use Notifiable;

    protected $table = 'garages_description';

    public $timestamps = false;

    public function garage()
	{
	    return $this->belongsTo('App\Garage','garage_id');
	}
}