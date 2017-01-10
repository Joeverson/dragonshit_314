<?php

namespace libs\util;

class Convert{
  public static function utf8_converter($array, $only=false){

        if($array == false)
            return $array;
        if($only)
            utf8_encode($array);
        else{
            array_walk_recursive($array, function(&$item, $key){
                if(!mb_detect_encoding($item, 'utf-8', true)){
                    $item = utf8_encode($item);
                }
            });
        }

        return $array;
    }
  
  public static function encodingCharEspecial($str){
		$simbols = array("'", "-", ".", "&", ";", "`", "_");
		$coding = array("&#39;", "&#45;", "&#46;", "&#38;", "&#59;", "&#96;", "&#95;");
	
		for($i=0; $i<count($simbols) ; $i++)
			if(strpos($str, $simbols[$i]) !== false)
				return str_replace($simbols[$i], $coding[$i], $str);
		
	}

}