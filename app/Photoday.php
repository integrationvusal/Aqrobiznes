<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Photoday
{
    private static $table = 'photoday';

    public static function get($fields='img'){
    	if(is_array($fields)) $f = implode(',', $fields);
    	$data = DB::select("SELECT {$f} FROM ".self::$table." ORDER BY ordering LIMIT 1")[0];
    	if(!is_array($fields)) return $data[$fields];
    	return $data;
    }
    
    public static function all(){
		return  DB::select("SELECT * FROM ".self::$table." ORDER BY ordering");
    }

}
