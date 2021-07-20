<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ServicePackage extends Authenticatable
{
   
    protected $table = 'service_package';

    protected $fillable = [
        'section_id', 'name', 'slug', 'description', 'package_for', 'price','promo_price','period','status','image','icon'
    ];

    public $timestamps = false;

    public function packageFeatures()
    {
        return $this->hasMany('App\ServicePackageFeature','service_package_id');
    }

    public function section()
	{
	    return $this->belongsTo('App\Section','section_id');
	}
	
	public function sectionsDescription()
	{
	    return $this->hasMany('App\SectionsDescription','section_id');
	}

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeDelete($query)
    {
        return $query->where('status', 2);
    }

    
}