<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Agrocalendar
{
    private static $table = 'agrocalendar';

    public static function get($fields='img'){
    	if(is_array($fields)) $f = implode(',', $fields);
    	$data = DB::select("SELECT {$f} FROM ".self::$table." ORDER BY ordering LIMIT 1")[0];
    	if(!is_array($fields)) return $data[$fields];
    	return $data;
    }
    
    public static function all(){
        $data = [];
		foreach(DB::select("SELECT * FROM ".self::$table." ORDER BY ordering") as $d){
		    $data[$d['id']] = $d;
		}
		return $data;
    }

    public static function last($limit=4){
        $data = [];
		foreach(DB::select("SELECT * FROM ".self::$table." ORDER BY ordering LIMIT {$limit}") as $d){
		    $data[$d['id']] = $d;
		}
		return $data;
    }

}
