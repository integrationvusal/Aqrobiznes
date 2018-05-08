<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Questions
{
    private static $table = 'questions';

    public static function get($fields='img'){
    	if(is_array($fields)) $f = implode(',', $fields);
    	$data = DB::select("SELECT {$f} FROM ".self::$table." ORDER BY ordering LIMIT 1")[0];
    	if(!is_array($fields)) return $data[$fields];
    	return $data;
    }
    
    public static function all(){
        $data = [];
		foreach(DB::select("SELECT * FROM ".self::$table." WHERE answer<> '' ORDER BY id DESC") as $d){
		    $data[$d['id']] = $d;
		}
		return $data;
    }
    
    public static function add($question){
        DB::insert("INSERT INTO ".self::$table." (question, answer, ordering) VALUES (?, ?, ?)", [$question, '', 0]);
    }

    public static function last($limit=4){
        $data = [];
		foreach(DB::select("SELECT * FROM ".self::$table." ORDER BY id DESC LIMIT {$limit}") as $d){
		    $data[$d['id']] = $d;
		}
		return $data;
    }

}
