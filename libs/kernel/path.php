<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/21/16
 * Time: 12:06 PM
 *
 * classe responsavel por cuidar de caminhos do sistema e formas de acessos de recurso
 */

namespace libs\kernel;


class path{
    /**
     *  path interno do sistema usado para recuperar recursos
    **/
    public static function path(){
        return self::adapterURI()."modules/";
    }

    /**
     *  path interno do sistema apartir da raiz do SO usado para recuperar recursos
     **/
    public static function dir(){
        return __DIR__."/../../modules/";
    }

    /**
     * gerador de links (adaptador)
    **/
    public static function linkTitle($link){
        $link = str_replace(" ", "-", $link);
        return $link;
    }

    /**
     * metodo de retorna o path do site
    **/
    public static function site(){
        return  self::adapterURI();
    }

    /**
     * metodo de adaptação de url
     **/
    private static function adapterURI(){
        $subpath = explode("/",$_SERVER['REQUEST_URI']);

        if(!preg_match("/([.])/",explode('/', $_SERVER['PHP_SELF'])[1]))//pega a primeira chamada padrão do apache e vé se eum a rquivo  ou um diretorio se dor um diretorio ele coloca no nome do diretorio como base apdrão
            return $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/".$subpath[1]."/";

        return  $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'] . '/';
    }
}