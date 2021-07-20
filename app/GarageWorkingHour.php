<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class GarageWorkingHour extends Authenticatable
{
    use Notifiable;

    protected $table = 'garage_working_hours';

    protected $fillable = [
        'garage_id', 'mon', 'tue', 'wed'.'thu','fri','sat','sun','status'
    ];

    public $timestamps = false;
}