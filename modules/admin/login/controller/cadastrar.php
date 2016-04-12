<?php
/**
 * Created by PhpStorm.
 * User: joerverson
 * Date: 2/22/16
 * Time: 10:13 AM
 *
 * TODO aqui tem a padronização de mensagem de retorno
 */

require '../../../../Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$db = new \modules\admin\user\models\DBUser;
$fn = new \libs\functions;

//limpando array
unset($_POST["pass1"]);
$_POST["pass"] = $_POST["pass2"];
unset($_POST["pass2"]);



if($db->existsUserForCodeMultiplicador($_POST['cod_multiplicador'])){
    //pegando o id do user
    $ar["id_user"] = $db->insertCadastro($fn->prepareArrayDoublePointer($_POST,false));

    $ar["date_ini"]= date("Y-m-d");

    //calculando data final adicionando 15 dias
    $d2 = explode('/', date('d/m/Y'));
    $ar["date_fin"] = date("Y-m-d",(mktime(0, 0, 0, $d2[1], ($d2[0]+15), $d2[2])));

    //ativo 1
    $ar['ativo'] = 1;

    $db->insertTimeAvaliacao($fn->prepareArrayDoublePointer($ar, false));
    //colocando o carinha na session
    $_SESSION['user'] = \libs\util::utf8_converter($db->auth(array("pass"=>$_POST['pass'], "name"=>$_POST["login"])));

    //inprimindo mesagems
    print json_encode(array("type"=>"success" , "message" => "Parabens!! Agora você faz parte do Multiplicador Online"));

    //enviando o email avisando da confirmação de login
    //TODO colocar aqui para enviar um email para o carinha que ta se inscrevendo e para o atendimento multiplicador


}else if($db->existsUserForCodeMultiplicador($_POST['login'])){
    //inprimindo mesagems
    print json_encode(array("type"=>"error" , "message" => "Login já existe, Por favor escolha outro nome de usuário"));
}else{
    //inprimindo mesagems
    print json_encode(array("type" => "error", "message" => "Multiplicador já existe, Caso tenha esquecido a seneha entre em contato com @pji.com"));
}


