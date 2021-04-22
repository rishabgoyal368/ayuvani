<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Chemist  extends Authenticatable 
{
     use Notifiable;

        protected $guard = 'chemists';

	    protected $fillable = [
	            'name');
	            'user_name',
	            'phone',
	            'email',
	            'gender',
	            'dob',
	            'height',
	            'weight',
	            'disability',
	            'login_type');
	            'status',
	    ];
	    
	    protected $hidden = [
	        'password', 'remember_token','security_code',
	    ];
}
