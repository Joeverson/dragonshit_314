<?php
/**
 * Definições basicas usadas em rotas:
 *  - pacote : area onde possue o admin ou site, é a raiz de uma parte importante do fluxo do sistema
 *  - pagina : tela index de modulo
 *  - modulo : conjunto de paginas fom funções especificas ou gerais para o funcionamento do sistema.
 *
 * */
session_cache_limiter(false);
session_start();

/// inicialização e configuração do slim
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array('templates.path' => 'modules')); // retorna a instancia
$app->config(array('debug'=>'true'));



//--------------------------------------
//update do sistema em desenvolvimento
 //\libs\autoUpdate::on();

//--------------------------------------


// instanciações de libs
$signIn = new \libs\login;
$user = new \libs\user;

// dados que é enviado comummente para todos as paginas renderizadas
$data = array("user" => $user);



/**
funções anonymas para as rotas:.
**/
$authentication = function(\Slim\Route $route) use ($data){
    $app = \Slim\Slim::getInstance();

    //só inicializa a variavel caso ela esteja vazia
    if(!isset($_SESSION['user']))
        $_SESSION['user'] = null;


    if(\libs\kernel\Security::filterRoutes(false)){
        if (!isset( $_SESSION["auth"]) || $_SESSION['auth'] == false){
            $app->render("admin/login/index.php", $data);
            exit;
        }
    }
};

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
//                                        LOGIN                                                        //
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//


// methodos que resolvem o login
$app->post('/login', function () use($signIn, $app, $data) {
    if(!empty($_POST['pass']))
        if($info = $signIn->singIn($_POST)){
            if(($info['date_fin'] >= date("Y-m-d")) && ($info['ativo'] != 0)){
                $_SESSION["user"] = $info; // guardando dados do usuario
                $_SESSION["auth"] = true;
                $app->render('admin/dashboard/index.php', $data);
            }
        }else
            redirectInit($app, "Usuário ou Senha inválidos");

});


//func criada só para diminuir repeticoes de codes
function redirectInit($app, $error){
    $data['error'] = $error;
    $app->render('admin/login/index.php', $data);
}

$app->get('/logout', function () use($signIn, $app, $data) {
    unset($_SESSION["user"]);
    unset($_SESSION["auth"]);
    session_destroy();
    $app->render('admin/login/index.php', $data);

});







//                                     ROTAS GENERICAS
//*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*//
//------------------  Quatro bases de rotas principais dentro do fluxo   ---------------------------------//
//*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*//


//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
//                                        BASE                                                         //
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//

// rota inicial - direcionada para o site (preferencialmente);
$app->get('/' , $authentication, function () use($app, $data) {
    try{
        $app->render('site/home/index.php', $data);
    }catch (\Exception $e){
        $app->render('404.html');
    }
});

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
//                                        NIVEL 1                                                      //
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//


// segunda nivel de rota - ideal para navegar entre paginas ( rota voltada para o site )
$app->get('/:page', $authentication, function ($page) use($app, $data) {
    try{
        if(\libs\kernel\Security::filterRoutes($page))//caso haja admin ele vai e manda para o manager
            $app->render($page.'/dashboard/index.php', $data);
        else
            $app->render('site/'.$page.'/index.php', $data);
    }catch(\Exception $e){
        $app->render('404.html');
    }
})->conditions(array('page' => '[a-z]{2,}'));



//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
//                                        NIVEL 2                                                      //
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//


// rota entre pacotes (site, admin... por exemplo) - recebe pacote e pagina.
$app->get('/:page/:subpage', $authentication, function ($page, $subpage) use($app, $data) {
    try{
         $app->render($page.'/'.$subpage . '/index.php', $data);
    }catch (\Exception $e){        
        $app->render('404.html');
    }
})->conditions(array('page' => '[a-z]{2,}'));


//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
//                                        NIVEL 3                                                      //
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//



// rota que leva a subModulos de um determinado pacote.
$app->get('/:page/:subpage/:file', $authentication, function ($page, $subpage, $file) use($app, $data) {
        try{
            $app->render($page.'/'.$subpage.'/'.$file.'.php', $data);
        }catch (\Exception $e){
            $app->render('404.html');
            //$app->render($page.'/'.$subpage.'/'.$file.'.php', $data);
        }
})->conditions(array('page' => '[a-z]{2,}', 'subpage' => '[a-z]{2,}', 'file' => '[a-z]{2,}'));



//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
//                                        NIVEL 4                                                      //
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//



// rota que leva a subModulos de um determinado pacote.
$app->post('/:page/:subpage/pages/:file', $authentication, function ($page, $subpage, $file) use($app, $data) {
    try{
        $app->render($page.'/'.$subpage.'/pages/'.$file.'.php', $data);
    }catch (\Exception $e){
        $app->render('404.html');
    }
})->conditions(array('page' => '[a-z]{2,}', 'subpage' => '[a-z]{2,}', 'file' => '[a-z]{2,}'));
/*---------------- end ------------------------*/


// rota de nivel 3 levando um id para configuração interna
$app->get('/:page/:subpage/:file/:id', $authentication, function ($page, $subpage, $file, $id) use($app, $data) {
        try{
            $data['id'] = $id;
            $app->render($page.'/'.$subpage.'/'.$file.'.php', $data);
        }catch (\Exception $e){
            $app->render('404.html');
        }
})->conditions(array('page' => '[a-z]{2,}', 'subpage' => '[a-z]{2,}', 'file' => '[a-z]{2,}'));

/*---------------- end ------------------------*/





//&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*
//*&*&*&*&*&*&*&*&   POST's  enviados por ajax  *&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&
//*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&


// users ajax -- user
$app->post('/user/create', function() use($user){
    echo $user->newUser($_POST);
});


$app->post('/user/edit', function() use ($user, $app){
    $array = $user->selectUser($_POST['id']);
    $array['id'] = $_POST['id'];
    $array['cat'] = $user->selectAllCategory();

    $app->render("admin/user/pages/edit.php", $array);
});
$app->post('/user/delete', function() use ($user, $app){
    $app->render("admin/user/pages/delete.php", ['id' => $_POST['id']]);
});

$app->post('/user/delete/:id', function($id) use ($user, $app){
    $user->deleteUser($id);
});


$app->post('/user/edit/:id', function($id) use ($user, $app){
   // $user->updateUser($_POST, $id);
});





//&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*
//*&*&*&*&*&*&*&*&   Serviços - requisisoes post  *&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&
//*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&*&

// retiorna dados do usuario dado o id
$app->post('/user/:id', function($id) use($user){
    echo json_encode($user->selectUser($id), JSON_FORCE_OBJECT);
});



// --- fim

$app->run();
