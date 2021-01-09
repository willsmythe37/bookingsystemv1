<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    //
    protected $fillable = [
        'roomname', 'shortdescription', 'longdescription', 'priceperhour', 'available', 'image1', 'showimage1',
    ];

    public function Booking()
    {
        return $this->hasMany(Booking::class);
    }
}
