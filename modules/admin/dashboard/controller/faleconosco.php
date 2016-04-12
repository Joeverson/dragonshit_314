<?php

/**
 *  este arquivo é para tão somente o envio de uma mail de sugestão ou reclamação
 *  para para a empresa.
 **/

require '../../../../Slim/Slim.php';
\Slim\Slim::registerAutoloader();

\libs\util\Email::prepare($_POST['email'],"[".$_POST['id_tipo']."]".$_POST['assunto'], $_POST['observacao']);
\libs\util\Email::send();