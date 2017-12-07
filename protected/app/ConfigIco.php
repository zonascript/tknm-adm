<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigIco extends Model
{
    protected $table = 'config_ico';
    protected $guarded = [];

    static function getConfigs(){
        return self::all();
    }

    static function getConfig($id){
        return self::where('id',$id)->first();
    }
}
