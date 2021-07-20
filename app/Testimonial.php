<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Testimonial extends Authenticatable
{
    use Notifiable;

    protected $table = 'testimonials';

    protected $fillable = [
        'name', 'image', 'status','designation','remarks'
    ];

    public $timestamps = false;
}