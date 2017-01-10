<?php
namespace modules\dashboard\controller;
use \libs\kernel\ControllerBase as CB;

class ControllerDashboard extends CB{

	public function index($app, $response){
         // resposta que vem do servidor => $response.
         // url onde esta o arquivo que vai ser renderizado.
         // argumento a serem passados para a pagina. => $args

         return $app->view->render($response, "/Dashboard/index.php");
	}
}