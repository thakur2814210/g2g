<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Garage extends Authenticatable
{
    use Notifiable;

    

    protected $table = 'garages';

    protected $fillable = [
        'slug','status','address','city_id','country_id','postal',
        'latitude','longitude','is_feature','opening_time','close_time','owner_name','owner_phone'
        ,'owner_email','owner_address','feature_image'
    ];

    public $timestamps = false;

    public function garageServices()
    {
        return $this->hasMany('App\GarageService','garage_id');
    }

    public function user()
	{
	    return $this->belongsTo('App\User','user_id');
	}

	public function city()
	{
	    return $this->belongsTo('App\City','city_id');
	}

	public function country()
	{
	    return $this->belongsTo('App\Country','country_id');
	}

    public function garageDescription()
    {
        return $this->hasMany('App\GaragesDescription','garages_id');
    }
    public function defaultGarageDescription()
    {
        return $this->hasMany('App\GaragesDescription','garages_id')->where('language_id', 1);
    }

  

	public function scopeApprovedGarage($query)
    {
        return $query->where('status', 1);
    }

    public function scopeDeletedGarage($query)
    {
        return $query->where('status', 2);
    }

    public function scopePendingGarage($query)
    {
        return $query->where('status', 3);
    }

    public function scopeFeaturedGarage($query)
    {
        return $query->where('is_feature', 1);
    }

    public function scopeUser($query , $value)
    {
        return $query->where('user_id', $value);
    }

    public function scopeDistance($query, $lat, $long, $distance) {
        return $query->filter(function ($query) use ($lat, $long, $distance) {
            $actual = 3959 * acos(
                cos(deg2rad($lat)) * cos(deg2rad(latitude))
                * cos(deg2rad(longitude) - deg2rad($long))
                + sin(deg2rad($lat)) * sin(deg2rad(latitude))
            );
            return $distance < $actual;
        });
    }


}