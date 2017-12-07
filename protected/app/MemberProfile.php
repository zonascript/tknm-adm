<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberProfile extends Model
{

    protected $table = 'user_profile';
    protected $guarded = [];
    public $timestamps = false;

    static function getMemberProfile($email){
        return self::where('email',$email)->first();
    }

    static function getMemberProfileFromUserId($id){
        return self::where('id_user',$id)->first();
    }

    static function getMemberProfiles(){
        return self::all();
    }
}
