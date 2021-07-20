<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ServiceRequestLog extends Authenticatable
{
   
    protected $table = 'service_request_logs';

    protected $fillable = [
        'service_request_id', 'description'
    ];

    public function serviceRequest()
	{
	    return $this->belongsTo('App\ServiceRequest','service_request_id');
	}

    public $timestamps = false;
}