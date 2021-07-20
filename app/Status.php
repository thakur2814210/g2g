<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Status extends Authenticatable
{
   
    protected $table = 'status';

    protected $fillable = [
        'name', 'is_enable',
    ];

    public $timestamps = false;
}
