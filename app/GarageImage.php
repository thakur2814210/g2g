<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class GarageImage extends Authenticatable
{
    use Notifiable;

    protected $table = 'garage_images';

    protected $fillable = [
        'garage_id', 'image', 'status'
    ];

    public $timestamps = false;
}