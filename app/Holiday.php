<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Holiday extends Model
{
    //
    protected $fillable = [
        'Holiday_start',
        'Holiday_end',
        'Holiday_title',
    ];

}
