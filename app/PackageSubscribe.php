<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PackageSubscribe extends Authenticatable
{
   
    protected $table = 'package_subscribe';

    protected $fillable = [
        'ps_code','cat_id', 'user_id','vehicle_id', 'garage_id', 'package_id','status'
    ];

    public $timestamps = false;

    public function category()
	{
	    return $this->belongsTo('App\Section','cat_id');
	}


    public function package()
	{
	    return $this->belongsTo('App\ServicePackage','package_id');
	}

	public function user()
	{
	    return $this->belongsTo('App\Client','user_id');
	}

	public function vehicle()
	{
	    return $this->belongsTo('App\Vehicle','vehicle_id');
	}
   
   public function status()
	{
	    return $this->belongsTo('App\Status','status');
	}
}
