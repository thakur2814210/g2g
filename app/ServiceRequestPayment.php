<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ServiceRequestPayment extends Authenticatable
{
   
    protected $table = 'service_request_payment';

    protected $fillable = [
        'service_request_id', 'amount','status','payment_type'
    ];

     public function serviceRequest()
	{
	    return $this->belongsTo('App\ServiceRequest','service_request_id');
	}

	public function scopePaymentSuccess($query){
		 return $query->where('service_request_payment.status', 1);
	}

	public function scopePaymentFailed($query){
		 return $query->where('service_request_payment.status', 2);
	}

	public function scopePaymentPending($query){
		 return $query->where('service_request_payment.status', 3);
	}

    public $timestamps = false;
}