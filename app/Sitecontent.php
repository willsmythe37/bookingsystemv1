<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sitecontent extends Model
{
    //
    protected $fillable = [
        'pagename', 'title1', 'body1', 'show1', 'image1', 'showimage1', 'title2', 'body2',  'show2', 'image2', 'showimage2', 'title3', 'body3', 'show3', 'image3', 'showimage3',
    ];
}
