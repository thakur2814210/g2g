<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Commission extends Authenticatable
{
   
    protected $table = 'commissions';

    protected $fillable = [
        'service_request', 'client_package_subscription', 'garage_package_subscription'
    ];

    public $timestamps = false;
}