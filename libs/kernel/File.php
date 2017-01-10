<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 4/12/16
 * Time: 12:37 AM
 */

namespace libs\kernel;


class File
{
    /**
     * busca um arquivo atraves de uma nome de diretorio, de forma recursiva.
     * 
     * _path -> deve ser colocado para ele gerar os arquivos padroes
    **/
    public static function findFilesNamesByDir($dir){

        $path = array();

        foreach(scandir(__dir__.'/../../'.$dir) as $k)
            if(($k != '.') && ($k != '..')) {

                if( strpos($k,'_') === 0)
                    $path[] = __dir__.'/../../'.$dir."/".$k;
                
                
            }


        return $path;
    }

    /**
     * metodo de injeção de codigo, ou seja é um metodo que inclue
     *trechos de codigo em um arquivo
     *
     * @param String $file nome/diretorio do arquivo onde está, no caso começa da base_template que são todos os arquivos/pastas
     * dentro de modules
     *
     **/
    public static function inject($file){

        include \sofia\kernel\path::dir().$file.".php";
        
    }

    /**
     * criando arquivos de log ou aquivo genericos
     **/

    public static function newFile($name,  $text){
        // Abre ou cria o arquivo bloco1.txt
        $fp = fopen($name, "a");
        $escreve = fwrite($fp, $text);
        fclose($fp);
    }
}
