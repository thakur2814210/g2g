<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class GarageReview extends Authenticatable
{
    use Notifiable;

    protected $table = 'garage_reviews';

    protected $fillable = [
        'garage_id', 'name', 'email','rating','review','status','users_id'
    ];

    public $timestamps = false;
}