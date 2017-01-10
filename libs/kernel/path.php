<?php
/**
 * Classe responsavel por disponibilizar os caminhos relativos e fixos do sistema para consumir recursos
 * internamente e externamente.
 *
 * @author joerverson <joerverson.santos@gmail.com>
 * @category utilidades
 * @version 0.1
 * @copyright GPL © 2016, PJI.
 * @access public
 * @example Classe path.
 * @package libs\kernel
 */

namespace libs\kernel;

class path{
    /**
     *  path interno do sistema usado para recuperar recursos
     *
     * @return string retorna o caminho para acesso a recursos internos que não são mapeados pelo "router.php" e que estão
     *dentro da pasta template do sistema "modules/"
    **/
    public static function path(){
        return self::adapterURI()."modules/";
    }
/**
 * metodo para pegar assets
**/
    public static function assets($file){
        return self::adapterURI()."assets/$file";
    }

    /**
     *  path interno do sistema apartir da raiz do SO usado para recuperar recursos
     *
     * @return string retorna o caminho desde a raiz do S.O. até a pasta template do sistema no caso "modules/"
     **/
    public static function dir(){
        return __DIR__."/../../modules/";
    }

    /**
     * gerador de links (adaptador)
     * @param String $link recebe o link a qual vai limpa-ló para poder ser um url aceitavel
     *
     *@return String retorna o link/nome corrigido para ser chamado por url
    **/
    public static function linkTitle($link){
        $link = str_replace(" ", "-", $link);
        return $link;
    }

    /**
     * metodo de retorna o path do site
     *
     * @return string retorna a url do sistema como acesso esterno (não usar essa URI para chamada de arquivos não indexados pelo router.php)
    **/
    public static function site(){
        return  self::adapterURI();
    }

    /**
     * metodo de adaptação de url, onde verifica se o sistema esta na raiz do servidor ou se ele é uma
     * subpasta de algum sistema/hospedagem
     *
     * @return String retorna a url adaptada do sistema
     **/
    private static function adapterURI(){
        $subpath = explode("/",$_SERVER['REQUEST_URI']);

        if($_SERVER['REQUEST_SCHEME'] == null)
            $_SERVER['REQUEST_SCHEME'] = "http";

        if($_SERVER['REQUEST_URI'] == "/")
            return  $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'] . '/';


        if(!preg_match("/([.])/",explode('/', $_SERVER['PHP_SELF'])[1]))//pega a primeira chamada padrão do apache e vé se eum a rquivo  ou um diretorio se dor um diretorio ele coloca no nome do diretorio como base apdrão
            return $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/".$subpath[1]."/";


    }
}
