<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Member extends Model
{

    protected $table = 'users';
    protected $guarded = [];

    static function getMembers(){
        return self::where('is_kyc','=',1)->get();
    }

    static function getMember($id){
        return self::where('id',$id)->first();
    }

    static function getMemberCount(){
        $c = 0;
        for($x=4;$x>=0;$x--){
            $temps = DB::select("SELECT DATE_FORMAT(date_sub(DATE_FORMAT(now(), '%Y-%m-01'), interval $x month), '%b-%y') as date, COUNT(id) as 'totaluser',(SELECT COUNT(id) FROM list_buyer WHERE created_at < date_sub(DATE_FORMAT(now(), '%Y-%m-01'), interval ($x-1) month)) as 'totalbuyer', (SELECT COUNT(id) FROM users WHERE isKYC = 1 AND created_at < date_sub(DATE_FORMAT(now(), '%Y-%m-01'), interval ($x-1) month)) as 'totalkyc' FROM users WHERE created_at < date_sub(DATE_FORMAT(now(), '%Y-%m-01'), interval ($x-1) month)");
            foreach ($temps as $temp){
                $memberCount[$c++]=[
                    'date' => $temp->date,
                    'totaluser' => $temp->totaluser,
                    'totalbuyer' => $temp->totalbuyer,
                    'totalkyc' => $temp->totalkyc
                ];
            }
        }
        return $memberCount;
    }
}
