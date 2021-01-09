<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Hireprice extends Model
{
    //
    protected $fillable = [
        'guitaramp', 'bassamp', 'drumkit',
    ];
}
