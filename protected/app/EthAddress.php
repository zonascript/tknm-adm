<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EthAddress extends Model
{
    protected $table = 'list_unused_ethereum_address';
    protected $guarded = [];

    static function getUnusedAddressCount(){
        return self::where('used','=',0)->count();
    }
}
