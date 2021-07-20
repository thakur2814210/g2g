<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class GaragePackageSubscribe extends Authenticatable
{
    use Notifiable;

    protected $table = 'garage_package_subscribe';

    protected $fillable = [
        'service_package_id', 'garage_id', 'status','amount','subscription_start_at','subscription_end_at','is_cancel','cancelled_at'
    ];

    public function garage()
	{
	    return $this->belongsTo('App\Garage','garage_id');
	}

	public function servicePackage()
	{
	    return $this->belongsTo('App\ServicePackage','service_package_id');
	}

    public $timestamps = false;
}