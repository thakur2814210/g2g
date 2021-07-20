<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class GaragePackageSubscribePayment extends Authenticatable
{
   
    protected $table = 'garage_package_subscribe_payments';

    protected $fillable = [
        'garage_package_subscribe_id', 'amount','status','payment_type'
    ];

    public function garagePackageSubscribe()
	{
	    return $this->belongsTo('App\GaragePackageSubscribe','garage_package_subscribe_id');
	}

    public $timestamps = false;
}