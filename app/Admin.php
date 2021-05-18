<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins';

    protected $fillable = [
        'user_name',
        'email',
        'security_code',
        'mobile_number',
        'profile_image',
        'password',
        'status'
    ];
}
