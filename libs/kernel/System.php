<?php
namespace libs\kernel;

class System{
    /**
     * essa função é responsavel por dar um ID para a aplicação e com ela ter o controle de
     * onde e quantos apps com sofia estão rodando.
     */
    public static function IDApp(){
        $path = __DIR__.'/../../Helper/ID';

        if(!file_exists($path)){
            mkdir($path,0777);
            $f = fopen($path.'/key.id','a');
            fwrite($f,time());
            fclose($f);
        }
    }

    public static function loadConfigEnvDB(){
        $f = file(__DIR__ . "/../../config-database.env");
        $type_config = "";

        foreach ($f as $line){
            if(preg_match("/=/", $line)){
                $v = explode("=", $line);

                if($v[0] == "RUN_DB"){
                    $_ENV[$v[0]] = $v[1];
                    continue;
                }

                $_ENV[$type_config][$v[0]] = $v[1];
            }else{
                $type_config = htmlspecialchars(explode("\n", $line)[0]);
            }
        }

    }
}