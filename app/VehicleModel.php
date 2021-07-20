<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class VehicleModel extends Authenticatable
{
   
    protected $table = 'vehicle_model';

    protected $fillable = [
        'vehicle_make_id', 'name', 'slug', 'active'
    ];

    public function make()
	{
	    return $this->belongsTo('App\VehicleMake','vehicle_make_id');
	}

	public function scopeActive($query) {
      return $query->where('active', 1);
    }

    public $timestamps = false;
}
