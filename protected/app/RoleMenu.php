<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    protected $table = 'role_menu';
    protected $guarded = [];

    static function getMenuForRole($id){
        return self::where('role',$id);
    }

    static function getRoleMenus(){
        return self::all();
    }
}
