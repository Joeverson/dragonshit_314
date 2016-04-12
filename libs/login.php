<?php
namespace libs;

class login{

    public function __construct(){}

    // pega a senha e verifica se existe no banco de dados

    public function singIn($array){
        $db = new \models\database;
        $array = \libs\util::utf8_converter($db->auth($array));

        if($r = $array) {
            return $r; // retorno para ajax
        }

        return false; // retorno para ajax
    }


    public function singOut(){

    }

}
