<?php

namespace App\Http;

class Helper
{
    public static function filename($path)
    {
        return pathinfo($path, PATHINFO_FILENAME);
    }

    public static function trans($id, $from, $to, $data){
    	return str_replace(trans($id, [], null, $from), trans($id, [], null, $to), $data);
    }
    
    
    public static function df($date, $format='d.m.Y'){
    	return date($format, strtotime($date));
    }

    public static function youtube($id, $width='100%', $height=418, $style='margin-bottom: -6px;'){
    	$id = explode('?v=',$id);
    	$id = $id[1]; 

    	return '<iframe width="'.$width.'" height="'.$height.'" style= "'.$style.'" src="https://www.youtube.com/embed/'.$id.'" frameborder="0" allowfullscreen></iframe>';
    }
}