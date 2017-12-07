<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntroText extends Model
{

    protected $table = 'introduction_text';
    protected $guarded = [];

    static function getIntroText($text_name){
        return self::where('text_name',$text_name)->first();
    }
}
