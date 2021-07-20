<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Role extends Authenticatable
{
   
    protected $table = 'roles';

    protected $fillable = [
        'name', 'slug', 'status',
    ];

    public $timestamps = false;
}
