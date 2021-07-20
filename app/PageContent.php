<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PageContent extends Authenticatable
{
   
    protected $table = 'page_contents';

    public $timestamps = false;
}
