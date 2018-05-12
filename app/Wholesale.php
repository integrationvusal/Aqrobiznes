<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
use App\Markets;

class Wholesale
{
    private static $table = 'wholesale';

    public static function get($fields='img'){
    	if(is_array($fields)) $f = implode(',', $fields);
    	$data = DB::select("SELECT {$f} FROM ".self::$table." ORDER BY ordering LIMIT 1")[0];
    	if(!is_array($fields)) return $data[$fields];
    	return $data;
    }
    
    public static function all(){
		$res = [];
		$markets = Markets::all();
		
		
		foreach(DB::select("SELECT a.*, p.name product, m.name measure FROM ".self::$table." a 
    		    LEFT JOIN product p ON p.id = a.product_id
    		    LEFT JOIN measure m ON m.id = a.measure_id 
		        ORDER BY a.date DESC") as $d){
		    
		    $d['prices'] = json_decode($d['prices'], true);
		    
		    foreach($d['prices']['types'] as $k=>$m)
		        $d['types'][$m][$markets[$d['prices']['markets'][$k]]['name']] = $d['prices']['prices'][$k];
		    
		    unset($d['prices']);
		    $res[date('d.m.Y',strtotime($d['date']))][$d['product']] = $d;
		}
		
		return $res;
    }
    
    public static function last(){
        $markets = Markets::all();
        $res = [];
        $d = DB::select("SELECT a.*, p.name product, m.name measure FROM ".self::$table." a 
    		    LEFT JOIN product p ON p.id = a.product_id
    		    LEFT JOIN measure m ON m.id = a.measure_id 
		        ORDER BY a.date DESC LIMIT 1");
		 if(!isset($d[0])) return [];
		 
		$d = $d[0];

		$d['prices'] = json_decode($d['prices'], true);
		 
		foreach($d['prices']['types'] as $k=>$m)
		        $d['types'][$m][$markets[$d['prices']['markets'][$k]]['name']] = $d['prices']['prices'][$k];
		    
	    unset($d['prices']);
	    $res[date('d.m.Y',strtotime($d['date']))][$d['product']] = $d;
	    return $res;
    }

}
