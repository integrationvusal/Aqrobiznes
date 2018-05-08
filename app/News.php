<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use App\Http\Helper;

class News
{
    private static $table = 'news';

    private static $perPage = 12;

    public static function all($type='news',$limit=false,$start=0, $dateformat = false, $category=0, $publish=false){

        $params = [
            ':lang'=>'az'
		];

        $type = implode(',', array_map(function($val){return "'{$val}'";}, explode(',', $type)));

        $cat = array_fill(null,  2, '');
        if($category){
            $cat[0] = 'LEFT JOIN news_cats_rel c ON a.id = c.news_id';
            $cat[1] = 'c.category_id=:category AND';
            $params[':category'] = $category;
        }

        $publish = !$publish?"AND a.is_published = '1'":null;

    	$data = DB::select("SELECT t.text, a.sef, a.is_published, a.counter, a.type, a.img,  a.add_datetime, a.publish_datetime FROM ".self::$table." a LEFT JOIN translates t ON a.id = t.ref_id {$cat[0]} AND t.ref_table ='".self::$table."' WHERE (t.fieldname = 'full' OR t.fieldname='title') AND a.type IN($type) AND {$cat[1]} lang = :lang {$publish} AND a.is_deleted='0'  ORDER BY a.id DESC, t.fieldname ".
        ($limit?('LIMIT '.($start*self::$perPage).', '.$limit*2):null) , $params);

    	$res= [];

    	for ($i=0; $i < count($data); $i+=2){

            $_ex = explode(' ', $data[$i]['add_datetime']);

            if($dateformat)
                $_time = date($dateformat, strtotime($data[$i]['add_datetime']));
            else
                $_time = Helper::trans('custom.months', 'en', 'az', date('j F Y', strtotime($data[$i]['add_datetime'])) );

            $res[] = [
                'time'=>$_time,
                'is_today'=>date('Y-m-d') === $_ex[0],
                'title'=>$data[$i+1]['text'],
                'sef'=>$data[$i]['sef'],
                'publish'=>$data[$i]['is_published'],
                'img'=>$data[$i]['img'],
                'content'=>$data[$i]['text'],
                'counter'=>$data[$i]['counter'],
                'type'=>$data[$i]['type'],
            ];

        }

		return $res;
    }

    public static function getContent($sef){
        return DB::select("SELECT c.category_id, t.text, a.img, a.counter, a.add_datetime FROM ".self::$table." a INNER JOIN translates t ON a.id = t.ref_id AND t.ref_table ='".self::$table."' LEFT JOIN news_cats_rel c ON a.id = c.news_id WHERE (t.fieldname = 'full' OR t.fieldname='title') AND a.sef = :sef AND lang = :lang AND a.is_published = '1' AND a.is_deleted='0'  ORDER BY t.fieldname DESC", [
            ':lang' => 'az',
            ':sef' => $sef
        ]);
    }

    public static function setCounter($sef){
    	DB::update('UPDATE '.self::$table.' SET counter=counter+1 WHERE sef = :sef', ['sef'=>$sef]);
    }

    public static function get($type='news', $dateformat=false, $publish=false, $category=0){
        $_data = self::all($type, 1, 0, $dateformat, $category, $publish);
        return ($_data)?$_data[0]:false;
    }
}
