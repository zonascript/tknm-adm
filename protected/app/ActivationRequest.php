<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivationRequest extends Model
{

    protected $table = 'KYC_request';
    protected $guarded = [];

    static function getRequest($email){
        return self::where('email',$email)->first();
    }

    static function getRequests(){
        return self::all();
    }
}
