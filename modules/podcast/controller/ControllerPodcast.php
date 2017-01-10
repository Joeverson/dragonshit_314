<?php
namespace modules\podcast\controller;
use \libs\kernel\ControllerBase as CB;

class ControllerPodcast extends CB{

	public function index($app, $response){
         // resposta que vem do servidor => $response.
         // url onde esta o arquivo que vai ser renderizado.
         // argumento a serem passados para a pagina. => $args
        $path = simplexml_load_file("http://www.deviante.com.br/feed/podcast/");
        $data = json_decode(json_encode($path), true);

         return $app->view->render($response, "/podcast/index.php" , ['data' => $data]);
	}
}