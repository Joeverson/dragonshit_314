<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 4/12/16
 * Time: 12:37 AM
 */

namespace libs\kernel;


class File
{
    /**
     * busca um arquivo atraves de uma nome de diretorio, de forma recursiva.
    **/
    public static function findFilesNamesByDir($dir){
        $path = array();
        foreach(scandir(__dir__.'/../modules/site/'.$dir) as $k)
            if(($k != '.') && ($k != '..')) {
                if($str = explode(' ', $k)){
                    $c = implode('', $str);

                    if(rename(__dir__.'/../modules/site/'.$dir.'/'.$k, __dir__.'/../modules/site/'.$dir.'/'.$c))
                        $path[] = $dir.'/'.$c;
                }else
                    $path[] = $dir.'/'.$k;


            }


        return $path;
    }

    /**
     * metodo de injeção de codigo, ou seja é um metodo que inclue
     *trechos de codigo em um arquivo
     **/

    public static function inject($file){
        //include "modules/".$file;
        include \libs\kernel\path::dir().$file;
    }
}