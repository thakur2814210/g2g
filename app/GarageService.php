<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class GarageService extends Authenticatable
{
    use Notifiable;

    protected $table = 'garage_services';

    protected $fillable = [
        'garage_id', 'cat_id', 'sub_cat_id'
    ];

    public $timestamps = false;

    public function garage()
	{
	    return $this->belongsTo('App\Garage','garage_id');
	}

	
}