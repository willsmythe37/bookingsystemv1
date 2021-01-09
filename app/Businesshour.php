<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Businesshour extends Model
{
    //
    protected $fillable = [
        'Mondaystart', 'Mondayend', 'Tuesdaystart', 'Tuesdayend', 'Wednesdaystart', 'Wednesdayend', 'Thursdaystart', 'Thursdayend', 'Fridaystart', 'Fridayend', 'Saturdaystart', 'Saturdayend', 'Sundaystart', 'Sundayend',
    ];
}
