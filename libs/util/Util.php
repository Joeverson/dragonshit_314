<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 4/12/16
 * Time: 12:40 AM
 */

namespace libs\util;


class Util
{
    /**
     * prepara um array para ser inserido em um query usando PDO, e tem uma flag que se for falso ele não
     * ignora campos vazios.
     *
     *
     *  input = array("casa"=>123)
     *  output = array(":casa"=>123)
     *
     *
     * @param $array
     * @return null
     */
    public static function prepareArrayDoublePointer($array, $flag = true){
        $newArray = array();

        if(!is_array($array) || empty($array))
            return null;

        foreach($array as $key => $val){
            if( $val == "" and $flag) continue;
            if( $key == 'pass' ){
                $newArray[':'.$key] = \libs\kernel\Security::segPassEncript($val);
                continue;
            }

            $newArray[':'.$key] = $val;
        }

        return $newArray;
    }
}