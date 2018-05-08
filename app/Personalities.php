<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Personalities
{
    private static $table = 'personalities';

    public static function all(){
		return  DB::select("SELECT * FROM ".self::$table." ORDER BY ordering");
    }

}
