<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Chemist  extends Authenticatable implements JWTSubject
{
     use Notifiable;

        protected $guard = 'chemists';

	    protected $fillable = [
	            'name',
	            'user_name',
	            'phone',
	            'email',
	            'gender',
	            'dob',
	            'height',
	            'weight',
	            'disability',
	            'login_type',
	            'status',
	    ];
	    
	    protected $hidden = [
	        'password', 'remember_token','security_code',
	    ];

	public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }
}
