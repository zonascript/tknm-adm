<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListWalletEth extends Model
{
    protected $table = 'list_wallet_ethereum';
    protected $guarded = [];

    static function getWallets(){
        return self::all();
    }

    static function getWallet($id){
        return self::where('id',$id)->first();
    }
}
