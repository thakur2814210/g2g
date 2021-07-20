<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class SeoPage extends Authenticatable
{
   
    protected $table = 'seo_pages';

    public $timestamps = false;
}
