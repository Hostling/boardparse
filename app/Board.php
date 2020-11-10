<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Board extends Model
{

    public $boards = ['sindom','leboard','divobazar', 'bonzon', 'rydo', '1000goods', 'kuraga', 'gorodets', 'sar164', 'itebe', 'zpost', 'apipost'];

    public static function getDescr($descr)
    {
    	$descr = preg_replace('/<div(.*?)>/is','',$descr);
		$descr = preg_replace('/<\/div>/is','',$descr);
		$descr = preg_replace('/"/is','',$descr);
		$descr = preg_replace('/[\r\n]/is','',$descr);
		return $descr;
    }
    public static function getTitle($title)
    {
    	$title = preg_replace('/"/is','',$title);
    	$title = preg_replace('/[\r\n]/is','',$title);
		return $title;
    }
    public static function getPrice($id){
    	$price = DB::table('dgimc_postmeta')->where('meta_key', '_price')->where('post_id', $id)->value('meta_value');
    	return $price;
    }
    public static function getImage($id)
    {
        $img = DB::table('dgimc_posts')->where('post_type', 'attachment')->where('post_parent', $id)->value('guid');
        return $img;
    }
    public static function isChecked($id, $boardName){
        $result = DB::table('parser')->where('num', $id)->where('site', $boardName)->first();
        $result = !empty($result)?"checked":"";
        return $result;
    }
}
