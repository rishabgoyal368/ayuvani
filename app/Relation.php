<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
	protected $guard = 'relations';

    protected $fillable = [
            				'name',
    					];
}
