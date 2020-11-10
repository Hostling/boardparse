<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sites extends Model
{	
	/*
	function __construct() {
		$this->ch = curl_init();
	}
	*/
    public function SiteAuth($curl, $post, $loginurl, $cookiename)
    {
    	curl_setopt($curl, CURLOPT_URL, $loginurl);
		curl_setopt($curl, CURLOPT_COOKIEJAR, $cookiename);
		curl_setopt($curl, CURLOPT_COOKIEFILE, $cookiename);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$html = curl_exec($curl);
		return $html;
    }
    public function GetPage($curl, $url, $cookiename)
    {
    	curl_setopt($curl, CURLOPT_URL, $url);
    	curl_setopt($curl, CURLOPT_COOKIEFILE, $cookiename);
    	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$html = curl_exec($curl);
		return $html;
    }
    public function MakeOb($curl, $post, $url, $cookiename)
    {
    	curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_COOKIEFILE, $cookiename);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$html = curl_exec($curl);
		return $html; 
    }
    public function findId($begin, $end, $body)
    {
    	$begin = preg_replace('/\//', '\/', $begin);
    	$begin = preg_replace('/\</is', '\<', $begin);
    	$begin = preg_replace('/\"/is', '\"', $begin);
    	$end = preg_replace('/\//', '\/', $end);
    	$end = preg_replace('/\</is', '\<', $end);
    	$end = preg_replace('/\"/is', '\"', $end);
    	$pattern = '/';
    	$pattern .= $begin;
    	$pattern .= '(.*?)';
    	$pattern .= $end;
    	$pattern .= '/is';
    	preg_match($pattern, $body, $result);
    	$result = $result[0];
    	$result = preg_replace('/'.$begin.'/', '', $result);
    	$result = preg_replace('/'.$end.'/', '', $result);
    	return $result;
    }
    public function dlImg($curl, $url)
    {
    	$filename = basename($url);
    	$dest_file = @fopen($filename, "w");
    	curl_setopt($curl, CURLOPT_URL, $url);
    	curl_setopt($curl, CURLOPT_FILE, $dest_file);
    	curl_setopt($curl, CURLOPT_HEADER, 0);
    	curl_exec($curl);
    	fclose($dest_file);
    	return $filename;
    }
    public function uploadImg($curl, $urlupload, $postdata, $cookiename)
    {
		curl_setopt($curl, CURLOPT_URL, $urlupload);
		curl_setopt($curl, CURLOPT_COOKIEFILE, $cookiename);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_HTTPHEADER,Array(
		'Content-Type: multipart/form-data'
		));
		curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$html = curl_exec($curl);
		return $html;
    }
    public function SetUploadedImg($curl, $editurl, $postudimg, $cookiename)
    {	
    	curl_setopt($curl, CURLOPT_URL, $editurl);
		curl_setopt($curl, CURLOPT_COOKIEFILE, $cookiename);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER,Array());
		curl_setopt($curl, CURLOPT_POSTFIELDS, $postudimg);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$html = curl_exec($curl);
		return $html;
    }
    public function SaveToDB($num, $board, $title, $editurl)
    {
    	DB::table('parser')->insert([
                'num' => $num,
                'site'=> $board,
                'title'=> $title,
                'link' => $editurl
            ]);
    }
    
}
