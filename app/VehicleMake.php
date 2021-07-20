<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class VehicleMake extends Authenticatable
{
   
    protected $table = 'vehicle_make';

    protected $fillable = [
        'name', 'active', 'slug'
    ];

    public function scopeActive($query) {
      return $query->where('active', 1);
    }

    public $timestamps = false;
}
