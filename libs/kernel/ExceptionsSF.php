<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 01/07/16
 * Time: 10:54
 *
 * essa classe é responsavel por tratar os erros dos do sistema
 */

namespace libs\kernel;


class ExceptionsSF
{

    /**
     * Esse metodo é responsavel por normatozar os erros onde irá tentar apresentar de forma amigavel os erros
     * que poderam aparecer no sistema, caso será feita uma forma padrão de apresentação de erros
    **/

    public static function run($e){
        $file = explode("/", $e->getFile());

        print "{line{\"".$e->getLine()."\"}file{".end($file)."}}";
    }
}