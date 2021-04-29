<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFamilyRelation extends Model
{
	protected $guard = 'users_family_relations';

    protected $fillable = [
            				'user_id',
            				'relation_id',
            				'dob',
            				'age',
            				'address',
            				'phone_no',
            				'email'
    					];}
