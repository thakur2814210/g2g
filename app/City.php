<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class City extends Authenticatable
{
   
    protected $table = 'cities';

    protected $fillable = [
        'name', 'country_id', 'status','slug','latitude','longitude'
    ];

    public function country()
	{
	    return $this->belongsTo('App\Country','country_id');
	}

	public function scopeActive($query) {
      return $query->where('status', 1);
    }

    public function scopeDelete($query) {
      return $query->where('status', 2);
    }


    public $timestamps = false;
}
