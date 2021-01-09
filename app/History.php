<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class History extends Model
{
    //
    protected $fillable = [
        'Booking_id',
        'Room_id',
        'roomname',
        'priceperhour',
        'User_id',
        'name',
        'surname',
        'band',
        'email',
        'phonenumber',
        'Booking_start',
        'Booking_end',
        'Cost_of_booking',
        'status',
        'equiptotal',
        'Payment_status',
        'wascreated_at',
        'wasupdated_at',
    ];

}
