<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Metacontent extends Model
{
    //
    protected $fillable = [
        'charset', 'keywords', 'description', 'author', 'refresh', 'viewport', 'title', 'customCSS',
    ];
}
