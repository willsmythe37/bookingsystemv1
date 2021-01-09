<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Weblink extends Model
{
    //
    protected $fillable = [
        'name', 'shortdescription', 'webURL', 'order',
    ];

}
