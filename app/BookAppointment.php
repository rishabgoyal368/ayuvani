<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookAppointment extends Model
{
	protected $guard = 'book_appointments';

    protected $fillable = [
            'user_id',
            'doctor_id',
            'date',
            'time',
            'virtual_care_consulation',
    ];
}
