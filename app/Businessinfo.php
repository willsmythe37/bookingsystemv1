<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Businessinfo extends Model
{
    //
    protected $fillable = [
        'copyrightyear', 'phonenumber', 'emailaddress', 'businessname', 'housenumber', 'streetname', 'town', 'county', 'postcode', 'image1', 'showimage1', 'emailnotifications'
    ];
}
