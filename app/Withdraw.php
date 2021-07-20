<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    public function vendor() {
      return $this->belongsTo('App\VendorDetails');
    }

    public function withdrawMethod() {
      return $this->belongsto('App\WithdrawMethod');
    }
}