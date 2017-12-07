<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\RoleMenu;

class Menu extends Model
{
    protected $table = 'menu';
    protected $guarded = [];

    static function getMenu($id){
        return self::where('id',$id)->first();
    }

    static function getMenus(){
        return self::all();
    }

    static function getMenuLevel1(){
        return DB::select("select * from menu where level = 1");
    }

    static function getMenuLevel2($parent){
        return DB::select("select * from menu where ((level = 2) AND (parent_id = $parent))");
    }

    static function getUserMenuLevel1($role){
        return DB::select("select * from menu where ((level = 1) AND (id = ANY(select menu from role_menu where role = $role))) ORDER BY id");
    }

    static function getUserMenuLevel2($role,$parent){
        return DB::select("select * from menu where ((level = 2) AND (parent_id = $parent) AND (id = ANY(select menu from role_menu where role = $role)))");
    }

    static function getChildPath($role,$parent){
        $temps = DB::select("select * from menu where ((level = 2) AND (parent_id = $parent) AND (id = ANY(select menu from role_menu where role = $role)))");

        $childPath = [];
        foreach($temps as $temp){
            $childPath[] = $temp->path;
        }

        return $childPath;
    }

    static function getPermittedMenu($role,$path){
        return DB::select("select * from menu where ((path = '$path') AND (id = ANY(select menu from role_menu where role = $role)))");
    }

    static function checkPermission($role,$id){
        $status = DB::select("select * from menu where ((id = $id) AND (id = ANY(select menu from role_menu where role = $role)))");
        if($status)
            return true;
        else
            return false;
    }

}
