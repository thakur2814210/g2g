<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class GarageVideo extends Authenticatable
{
    use Notifiable;

    protected $table = 'garage_videos';

    protected $fillable = [
        'garage_id', 'video', 'status'
    ];

    public $timestamps = false;
}