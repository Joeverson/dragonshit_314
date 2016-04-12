<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/18/16
 * Time: 10:24 AM
 */

namespace libs\performace;


class BigSelectHelper{

    private static $count; //quandtidade de tuplas para ele fazer a busca
    private static $data; //todos os dados pegos do db
    private static $db; //banco de dados
    private static $infs;//informações para  griação da query-> onde é um array de informações que são usadas no createQuery

    public  static function build($db, $array){
        self::$db = $db;
        self::$infs = $array;

        var_dump(self::$db->get(\libs\functions::generateQuerySqlSelectPDO(self::$infs[0], self::$infs[1], self::$infs[2], self::$infs[3], true)));

        //executando operações
        //self::count();
    }

    public static function see($class){
        $class->forward([self::$db, self::$infs]);
    }

    private static function count(){
        //pegando a quantidade de itens que quer buscar
        self::$count =  self::$db->get(\libs\functions::generateQuerySqlSelectPDO(self::$infs[0], self::$infs[1], self::$infs[2], self::$infs[3], true))[0]['count'] ;
    }

    private static function getDataPart(){

    }

}