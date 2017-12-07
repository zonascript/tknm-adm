<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin_user';
    protected $guarded = [];

    static function getUser($email){
        return self::where('email',$email)->first();
    }

    static function getUserByid($id){
        return self::where('id',$id)->first();
    }

    static function getUsers(){
        return self::all();
    }

}
