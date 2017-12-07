<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'admin_role';
    protected $guarded = [];

    static function getRole($id){
        return self::where('id',$id)->first();
    }

    static function getRoles(){
        return self::all();
    }
}
