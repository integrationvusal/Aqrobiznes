<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Menu
{
    private static $table = 'menu';

    public static function getMenu($parent=false){
    	$menu = [];

		$menu = DB::select("SELECT n.*, tr.text AS name
			FROM ".self::$table." n
				LEFT JOIN translates tr ON tr.ref_table=:menu AND tr.ref_id=n.id AND tr.lang=:default_site_lang AND tr.fieldname='name'
			WHERE is_published='1' AND is_deleted='0'".(empty($parent)? " AND parent_id='0'": (" AND parent_id='".(int)$parent."'"))."
			ORDER BY ordering ASC", [
			':default_site_lang' => 'az',
			':menu' => self::$table
		]);

		if (!empty($menu) && is_array($menu)) foreach ($menu as $i=>$item) {
			$children = self::getMenu($item['id']);
			if (!empty($children) && is_array($children)) {
				$menu[$i]['children'] = $children;
			}
		}

		return $menu;
    }

    public static function getContent($slug){

    	return current(DB::select("SELECT n.*, tr.text FROM ".self::$table." n
			LEFT JOIN translates tr ON tr.ref_table=:menu AND tr.ref_id=n.id AND tr.lang=:default_site_lang AND tr.fieldname='name'
			WHERE is_deleted='0' AND sef = :slug LIMIT 1", [
			':default_site_lang' => 'az',
			':menu' => self::$table,
			':slug' => $slug
		]));
    }
    
    public static function getByID($id){

    	return current(DB::select("SELECT n.*, tr.text FROM ".self::$table." n
			LEFT JOIN translates tr ON tr.ref_table=:menu AND tr.ref_id=n.id AND tr.lang=:default_site_lang AND tr.fieldname='name'
			WHERE is_deleted='0' AND n.id = :id LIMIT 1", [
			':default_site_lang' => 'az',
			':menu' => self::$table,
			':id' => $id
		]));
    }
    
    public static function getByType($type){

    	return current(DB::select("SELECT n.*, tr.text FROM ".self::$table." n
			LEFT JOIN translates tr ON tr.ref_table=:menu AND tr.ref_id=n.id AND tr.lang=:default_site_lang AND tr.fieldname='name'
			WHERE is_deleted='0' AND n.type = :type LIMIT 1", [
			':default_site_lang' => 'az',
			':menu' => self::$table,
			':type' => $type
		]));
    }
}
