<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Country extends Authenticatable
{
   
    protected $table = 'countries';

    protected $fillable = [
        'name', 'status','slug'
    ];

    public function scopeActive($query) {
      return $query->where('status', 1);
    }

    public function scopeDelete($query) {
      return $query->where('status', 2);
    }

    public $timestamps = false;
}
