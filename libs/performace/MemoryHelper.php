<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 4/1/16
 * Time: 9:46 AM
 */

namespace libs\performace;


class MemoryHelper
{
    public static function memoryAllocated(){
        print "<br/>Memoria alocada pelo php ->> ".memory_get_peak_usage();
    }

    public static function memoryAllocatedFoScript(){
        print "<br/>Memoria alocada no script php ->> ".memory_get_usage();
    }

    /**
     * este metodo e responsavel por almentar a memoria usada pelo php
     * onde o maximo é 16mb
    **/
    public static function upMemory($size){
        ini_set('memory_limit',$size.'M');
    }


}