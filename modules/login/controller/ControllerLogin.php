<?php
namespace modules\login\controller;
use \libs\kernel\ControllerBase as CB;
use modules\DB;

class ControllerLogin extends CB{

	public function index($app, $response){
		$app->view->render($response,"/login/index.php");
	}

	public function logout($app, $response){
		\libs\kernel\Auth::remove();

		$app->view->render($response,"/login/index.php");
	}


	public function login($app, $response, $post){
		$db = \libs\database\DB::instance();

		$rest = $db->select("user",
            [   "[<]membro"=>["membro_id"=>"id"]
            ],
            "*",
            ["AND" =>
                [
                    "user.login" => $post["name"] ,
                    "user.senha" => \libs\kernel\Security::segPassEncript($post["pass"])
                ]
            ])[0];
        
		if($rest != null){
			\libs\kernel\Auth::setUser($rest);

            $data = [
                "membros" => $db->select("membro",
                    ["[>]tipo"=>["tipo"=>"id"]],
                    ["membro.nome","tipo.nome_tipo"])
            ];

			$app->view->render($response,"/dashboard/index.php", $data);
		}else
		    $app->view->render($response,"/user/login.php",['error'=>"Login ou senha errados"]);

	}

	//pagina de adicionar novo usuario
    public function add($app, $response)
    {
        $db = \libs\database\DB::instance();

        $data = [
            "membros" => $db->select("membro",
                ["[>]tipo"=>["tipo"=>"id"]],
                ["membro.nome","tipo.nome_tipo", "membro.id"])
        ];


        $app->view->render($response,"/user/signin.php", $data);
    }

	//metodo enviado por post
	public function signin($app, $response, $post){
		$db = \libs\database\DB::instance();

		$post["senha"] = \libs\kernel\Security::segPassEncript($post["senha"]);

        $data = [
            "membros" => $db->select("membro",
                ["[>]tipo"=>["tipo"=>"id"]],
                ["membro.nome","tipo.nome_tipo", "membro.id"]),
        ];

		if($db->select("user", "*", ["AND" => ["nome"=>$post['nome'], "membro_id"=>$post['membro_id']]]) == false)
            $db->insert('user', $post);
        else
            $data["error"] = "Usuário já existe.";

		$app->view->render($response,"/user/signin.php", $data);
	}

    //pagina de adicionar novo usuario
    public function edit($app, $response)
    {
        $db = \libs\database\DB::instance();

        $data = [
            "membro" => $db->select("membro",
                [
                    "[>]tipo"=>["tipo"=>"id"],
                    "[>]user" =>["id"=>"membro_id"]
                ],
                "*",
                ["membro.id"=>\libs\kernel\Auth::getUser()['id']])[0],
            "celulas" => $db->select("celula","*")
        ];

        $app->view->render($response,"/user/edit.php", $data);
    }
}
