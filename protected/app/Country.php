<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    protected $table = 'country_list';
    protected $guarded = [];

    static function getcountry($id){
        return self::where('id',$id)->first();
    }

}
