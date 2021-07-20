<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ClientPackageSubscribe extends Authenticatable
{
    use Notifiable;

    protected $table = 'client_package_subscribe';

    protected $fillable = [
        'client_id','vehicle_id','service_package_id', 'garage_id', 'status','amount','subscription_start_at','subscription_end_at','description','grace_period','grace_interval','cancelled_at'
    ];

    public function garage()
	{
	    return $this->belongsTo('App\Garage','garage_id');
	}

	public function client()
	{
	    return $this->belongsTo('App\Client','client_id');
	}

	public function vehicle()
	{
	    return $this->belongsTo('App\Vehicle','vehicle_id');
	}

	public function servicePackage()
	{
	    return $this->belongsTo('App\ServicePackage','service_package_id');
	}

    public $timestamps = false;
}