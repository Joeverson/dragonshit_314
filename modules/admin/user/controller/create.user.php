<?php
require '../../../../Slim/Slim.php';
\Slim\Slim::registerAutoloader();

session_start();

$db = new \modules\admin\user\models\DBUser;
$fn = new \libs\functions;

if($_POST["id_tipo"] == 1){
    $_POST["id_multiplicador"] = $_SESSION['user']["id_user"];
}else{
    $_POST["id_multiplicador"] = 0; // indicando que ele é  proprio dono
}


$db->insertUser($fn->prepareArrayDoublePointer($_POST, false));

