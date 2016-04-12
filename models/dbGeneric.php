<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/18/16
 * Time: 10:31 AM
 */

namespace models;


interface dbGeneric{
    public function get($query);
}