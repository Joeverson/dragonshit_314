<?php
namespace libs;
use models\database;

class user extends database{
    private $bd;

    public function  __construct(){}

    public function selectAllUser(){
        return parent::selectAllUser();
    }

    public function selectUser($id){
        return parent::selectUser($id);
    }

    public function newUser($args){
        $array = \libs\util\Util::prepareArrayDoublePointer($args);
        $array[':pass'] = \libs\kernel\Security::segPassEncript($array[':pass']);

        return $this->insertUser($array);
    }

    public /* static */ function updateUser($array, $id){
        return $this->updateUser(\libs\util\Util::prepareArrayDoublePointer($array), $id);
    }

    public function deleteUser($id){
        return $this->deleteUser($id);
    }

    public function selectAllCategory(){
        return parent::selectAllCategory();
    }

}