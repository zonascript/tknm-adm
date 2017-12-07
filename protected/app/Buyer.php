<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    protected $table = 'list_buyer';
    protected $guarded = [];

    static function getBuyers(){
        return self::all();
    }

    static function getBuyer($type){
        return self::where('payment_type',$type)->get();
    }
}
