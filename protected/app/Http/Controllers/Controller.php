<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User as User;
use App\RoleMenu as RoleMenu;
use App\Menu as Menu;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function getUser(){
        $temp = User::getUser(Auth::user()->email);

        $userProfile=[
            'id' => $temp->id,
            'name' => $temp->name,
            'email' => $temp->email,
            'role' => $temp->role,
            'photo' => ''
        ];

        return $userProfile;
    }

    function getUserMenu($role){
        $x = 0;
        foreach(Menu::getUserMenuLevel1($role) as $tempLevel1){
            $userMenu[$x++] = [
                'name' => $tempLevel1->name,
                'icon' => $tempLevel1->icon,
                'path' => $tempLevel1->path,
                'child' => Menu::getUserMenuLevel2($role,$tempLevel1->id),
                //cek active
                'childPath' => Menu::getChildPath($role,$tempLevel1->id)
            ];
        };

        if(isset($userMenu))
            return $userMenu;
        else
            return NULL;
    }

    function isPermitted($role,$path){
        if(Menu::getPermittedMenu($role,$path))
            return true;
        else
            return false;
    }

    function logging($table,$action){
        try{

            Log::create([
               'admin_id'   => Auth::user()->id,
               'table'      => $table,
               'action'     => $action
            ]);

            return true;
        }catch(\Exception $e){
            return false;
        }
    }

}
