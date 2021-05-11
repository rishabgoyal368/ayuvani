<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
            'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','security_code',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function addEdit($data)
    {
        return User::updateOrCreate(
            ['id' => @$data['id']],
            [
                'first_name' => @$data['first_name'],
                'last_name' => @$data['last_name'],
                'email' => @$data['email'],
                // 'email_verified_at' => @$data['email_verified_at'],
                'mobile_number' => @$data['mobile_number'],
                // 'profile_image' => @$data['profile_image'],
                'password' => @$data['password'],
                'status' => @$data['status']
            ]
        );
    }

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }
}
