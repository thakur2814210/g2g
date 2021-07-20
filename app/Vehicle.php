<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Vehicle extends Authenticatable
{
   
    protected $table = 'vehicles';

    protected $fillable = [
        'client_id', 'name', 'registration_no', 'chassis_no', 'plate_no', 'make','model','color', 'year','current_mileage','status'
    ];

    public function vmake(){
    	return $this->belongsTo('App\VehicleMake','make' , 'id');
    }

    public function vmodel(){
    	return $this->belongsTo('App\VehicleModel','model' , 'id');
    }



    public $timestamps = false;
}
