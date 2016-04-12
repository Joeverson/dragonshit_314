<?php
require '../../../../Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$db = new \modules\admin\user\models\DBUser;
$fn = new \libs\functions;

$db->updateUser($fn->generateQuerySqlUpdatePDO("user",$_POST,$_POST['id_user'], "id_user"));