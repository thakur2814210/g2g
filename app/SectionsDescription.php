<?php
namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class SectionsDescription extends Authenticatable
{
    use Notifiable;

    protected $table = 'sections_description';

    public $timestamps = false;

    public function section()
	{
	    return $this->belongsTo('App\Section','sections_id');
	}
}