<?php

/**
arquivo usado para direcionar para o arquivo de rotas do slim
**/
session_start();

require 'vendor/autoload.php';

/**
 * autoload de arquivos/class de libs e formas gerais as que não pegam no vendor
 **/
spl_autoload_register(function ($class_name) {

    $ds = DIRECTORY_SEPARATOR;

    if(preg_match('/vendor/', $class_name) == 0){
        //preparando as barras
        $class_name = str_replace("\\", $ds, $class_name);

        require_once  __DIR__.$ds.$class_name . '.php';
    }
});


require_once 'controller/routes.php';
