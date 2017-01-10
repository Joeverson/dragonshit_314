<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 05/09/16
 * Time: 16:43
 */

namespace libs\kernel;
use \libs\database\DB;

class ControllerBase{

    public static function db()
    {
        return DB::instance();
    }

    /**
     * classe nativa que gera o json das informações do modulos atravez de seu ID
     *
     * rota para alcançar as informações por json --> class/id/json
    **/

    public function json($app, $response, $args){
        header('Content-Type: application/json');
        if(!isset($args['id']))
            print json_encode(self::db()->select($args['class'], "*"));
        else
            print json_encode(self::db()->select($args['class'], "*", ["id" => $args['id']]));
        die();
    }
}