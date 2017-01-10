<?php
namespace libs\ManagerModules;

use libs\kernel\path;

class ManagerModules{

    private static $pathName;

    public static function scan(){

        foreach(\libs\kernel\File::findFilesNamesByDir("modules") as $dir){


            if(!is_writable($dir)){
                print "<< [create_modules] Error: Permisões no diretorio negado! [".substr(end(explode("/", $dir)), 1)."]>>\n";
                continue;
            }

                
            
            self::$pathName = ucfirst(substr(end(explode("/", $dir)), 1));// aqui esa tirando o nome da pasta no meio do path e tirando o _ e deixando captalize

            $n = explode('/', $dir);
            array_pop($n);
            $n[] = strtolower(self::$pathName);
            $n = implode('/', $n);


            //renomeando a pasta para a forma correta
            rename($dir, $n);
            
            //novo path para adição de informações pastas e files
            $dir = $n;
            
            self::defaultDirectory($dir);
            self::defaultFiles($dir);

        }

    }

    /**
     * gera os novos diretorios padroes
    **/
    private static function defaultDirectory($dir){
        $dirs = array("controller", "model");

        foreach ($dirs as $d){
            if(!file_exists($dir . "/" . $d)) {
                if (@!mkdir($dir . "/" . $d, 0777))//criar arquivo de log caso não crie o path
                    print "<< [create_path_" . self::$pathName . "] Error ao criar o diretorio << " . self::$pathName ."/".$d. " >>\n";

            }
        }
    }

    /**
     * gera os arquivos padroes dentro do modules
    **/

    private static function defaultFiles($dir){

        //gerando o model
        $model = "<?php\nnamespace modules\\".strtolower(self::$pathName)."\\model;\n\nclass ".self::$pathName."s implements \\libs\\database\\model\n{\n\tpublic function create()\n\t{\n\t\treturn array(\n\n);\t\n}\n}\n";
        \libs\kernel\File::newFile($dir."/model/".self::$pathName."s.php", $model);
        
        
        //gerando o controller
        $controller = "<?php\nnamespace modules\\".strtolower(self::$pathName)."\\controller;\nuse \\libs\\kernel\\ControllerBase as CB;\n\nclass Controller".self::$pathName." extends CB{\n\n\tpublic function index(\$app, \$response){\n // resposta que vem do servidor => \$response. \n // url onde esta o arquivo que vai ser renderizado. \n // argumento a serem passados para a pagina. => \$args \n\n return \$app->view->render(\$response, \"/".ucfirst(self::$pathName)."/index.php\");\n\t}\n}";
        \libs\kernel\File::newFile($dir."/controller/Controller".self::$pathName.".php", $controller);

        //gerando o manifest json
        $manifestJson = "{\n\"dad\": \"this\",\n\"dadsName\": \"master\",\n\"acessLevel\": \"0\",\n\"title\": \"".self::$pathName."\",\n\"url\": ".strtolower(self::$pathName)."\",\n\"submenu\": []\n}";
        \libs\kernel\File::newFile($dir."/manifest.json", $manifestJson);
        
        
        //gerando o index
        \libs\kernel\File::newFile($dir."/index.php", "");
    }


}