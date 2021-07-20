<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class GaragePackageSubscribeLog extends Authenticatable
{
   
    protected $table = 'garage_package_subscribe_logs';

    protected $fillable = [
        'garage_package_subscribe_id', 'description'
    ];

    public function garagePackageSubscribe()
	{
	    return $this->belongsTo('App\GaragePackageSubscribe','garage_package_subscribe_id');
	}

    public $timestamps = false;
}