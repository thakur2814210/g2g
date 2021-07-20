<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ClientPackageSubscribePayment extends Authenticatable
{
   
    protected $table = 'client_package_subscribe_payments';

    protected $fillable = [
        'client_package_subscribe_id', 'amount','status','payment_type'
    ];

    public function clientPackageSubscribe()
	{
	    return $this->belongsTo('App\ClientPackageSubscribe','client_package_subscribe_id');
	}

	public function scopePaymentSuccess($query){
		 return $query->where('status', 1);
	}

	public function scopePaymentFailed($query){
		 return $query->where('status', 2);
	}

	public function scopePaymentPending($query){
		 return $query->where('status', 3);
	}

    public $timestamps = false;
}