<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Faq extends Authenticatable
{
   
    protected $table = 'faq';

    protected $fillable = [
        'cat_name', 'heading', 'heading', 'status'
    ];

    public $timestamps = false;
}
