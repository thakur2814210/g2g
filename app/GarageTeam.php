<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class GarageTeam extends Authenticatable
{
    use Notifiable;

    protected $table = 'garage_teams';

    protected $fillable = [
        'garage_id', 'first_name', 'last_name','phone','image','email', 'address','city','country','postal','gender','status'
    ];

    public $timestamps = false;
}