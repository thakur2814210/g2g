<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ServicePackageFeature extends Authenticatable
{
   
    protected $table = 'service_package_features';

    protected $fillable = [
        'service_package_id', 'feature_name', 'feature_value','status'
    ];

    public $timestamps = false;

    public function package()
	{
	    return $this->belongsTo('App\Package','package_id');
	}

	public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeDelete($query)
    {
        return $query->where('status', 2);
    }

    public function scopeUnpublished($query)
    {
        return $query->where('status', 3);
    }


	
}
