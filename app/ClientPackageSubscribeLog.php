<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ClientPackageSubscribeLog extends Authenticatable
{
   
    protected $table = 'client_package_subscribe_logs';

    protected $fillable = [
        'client_package_subscribe_id', 'description','type'
    ];

    public function clientPackageSubscribe()
	{
	    return $this->belongsTo('App\ClientPackageSubscribe','client_package_subscribe_id');
	}

    public $timestamps = false;
}