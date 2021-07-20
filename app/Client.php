<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    protected $table = 'clients';

    protected $fillable = [
        'user_id','company','image','status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function scopeActiveClient($query)
    {
        return $query->where('status', 1);
    }

    public function scopeDeleteClient($query)
    {
        return $query->where('status', 2);
    }

    public function scopePendingClient($query)
    {
        return $query->where('status', 3);
    }

    public $timestamps = false;
}
