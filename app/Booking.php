<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Booking extends Model
{
    //
    protected $fillable = [
        'Room_id',
        'User_id',
        'Booking_start',
        'Booking_end',
        'Cost_of_booking',
        'Payment_status',
    ];

    public function Room()
    {
        return $this->belongsTo('App\Room', 'Room_id', 'id');
    }

    public function User()
    {
        return $this->belongsTo('App\User', 'User_id', 'id');
    }

    public function Equip()
    {
        return $this->hasOne('App\Equip');
    }
}
