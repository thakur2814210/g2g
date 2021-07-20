<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ClientLocation extends Authenticatable
{
    use Notifiable;

    protected $table = 'client_locations';

    protected $fillable = [
        'client_id','address','additional_address','latitude','longitude','city_id','country_id','pobox','status'
    ];

   	public function client()
	{
	    return $this->belongsTo('App\Client','client_id');
	}

	public function city()
	{
	    return $this->belongsTo('App\City','city_id');
	}

	public function country()
	{
	    return $this->belongsTo('App\Country','country_id');
	}

	public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

    public $timestamps = false;
}
