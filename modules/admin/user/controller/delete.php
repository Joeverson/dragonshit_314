<?php
require '../../../../Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$db = new \modules\admin\user\models\DBUser;
//todo no futuro não vamos deletar mesmo vamos só inativar, já que com isso podemos ter historico das coisas que o rarinha já fez ou gerenciou
$db->deleteUser($_POST['id']);
