<?php
namespace libs\view;
/**
 * Created by PhpStorm.
 * User: root
 * Date: 03/09/16
 * Time: 01:07
 */
class Load
{

    /**
     * metodo responsavel por carregar os assets que foram adicionados por NPM
     *
     * @param mixed[] $itens nomes dos assets que ele vai inplantar
     *
     *@return string $string retorna as tags de implantação
     **/
    public static function assets($itens = []){
        $tagCss = "<link rel='stylesheet' href='here'>\n";
        $tagJs = "<script src=\"here\"></script>\n";

        $path_base = __dir__.'/../../node_modules';
        $tags = "";

        foreach(scandir($path_base) as $k)// pegando os paths dentro de node_modules
            if(($k != '.') && ($k != '..')) {
                if(file_exists($path_base . "/" . $k . "/dist"))//verificando se existe dist dentro dos paths
                    foreach (scandir($path_base."/".$k."/dist") as $g){
                        if(($g != '.') && ($g != '..')){

                            $file = preg_match("/\./", $g) ? $g : false; //verificando se é arquivo


                            if($file){ //preparando as tags de inclução css e js
                                switch (end(explode(".", $g))){
                                    case "js":
                                        $tags .= str_replace("here", \libs\kernel\path::path()."../node_modules/".$k."/dist/".$g, $tagJs);
                                        break;
                                    case "css":
                                        $tags .= str_replace("here", \libs\kernel\path::path()."../node_modules/".$k."/dist/".$g, $tagCss);
                                        break;
                                }
                            }else{
                                foreach (scandir($path_base."/".$k."/dist/".$g) as $h){
                                    if(($h != '.') && ($h != '..')){


                                        switch (end(explode(".", $h))){
                                            case "js":
                                                $tags .= str_replace("here", \libs\kernel\path::path()."../node_modules/".$k."/dist/".$g."/".$h, $tagJs);
                                                break;
                                            case "css":
                                                $tags .= str_replace("here", \libs\kernel\path::path()."../node_modules/".$k."/dist/".$g."/".$h, $tagCss);
                                                break;
                                        }
                                    }
                                }
                            }

                        }
                    }
            }

        print $tags;
    }
}
?>
