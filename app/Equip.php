<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Equip extends Model
{
    //
    protected $fillable = [
        'Booking_id',
        'guitarheadamount',
        'guitarcabamount',
        'guitarcomboamount',
        'bassheadamount',
        'basscabamount',
        'basscomboamount',
        'drumkitamount',
        'cymbalsamount',
        'equiptotal',
    ];

    public function Booking()
    {
        return $this->belongsTo('App\Booking', 'Booking_id', 'id');
    }
}
