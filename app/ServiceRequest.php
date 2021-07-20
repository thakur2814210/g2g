<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ServiceRequest extends Authenticatable
{
   
    protected $table = 'service_request';

    protected $fillable = [
        'sr_code','cat_id', 'client_id','vehicle_id', 'garage_id', 'address', 'city', 'pobox','faults_remarks','image','status','section_ids','appointment_at','quote_amount','amount_json','vip_pickup_opted','vip_pickup_price','image1','image2','image3','image4','image5','video'
    ];

    protected $casts = [
        'amount_json' => 'array',
    ];

    public $timestamps = false;

    public function category()
	{
	    return $this->belongsTo('App\Section','cat_id');
	}

	public function client()
	{
	    return $this->belongsTo('App\Client','client_id');
	}

	public function vehicle()
	{
	    return $this->belongsTo('App\Vehicle','vehicle_id');
	}

	public function garage()
	{
	    return $this->belongsTo('App\Garage','garage_id');
	}

	
	public function t_city()
	{
	    return $this->belongsTo('App\City','city');
	}

	public function t_country()
	{
	    return $this->belongsTo('App\Country','country');
	}
	
	public function scopeFindUser($query , $value)
    {
        return $query->where('user_id', $value);
    }

    public function scopeFindGarage($query , $value)
    {
        return $query->where('garage_id', $value);
    }
}
