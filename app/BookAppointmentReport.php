<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookAppointmentReport extends Model
{
    protected $guard = 'book_appointment_reports';

    protected $fillable = [
            'user_id',
            'doctor_id',
            'transaction_id',
            'response',
    ];
}
