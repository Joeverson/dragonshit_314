<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 4/12/16
 * Time: 12:44 AM
 */

namespace libs\kernel;


class Security
{

    /**
     * metodo basico responsavel por criptografar informações
     **/

    public static  function segPassEncript($pass){
        return md5(sha1($pass));
    }

    /**
     * checa o tipo de acesso do manifest json e retorna um boolean informando
     * se pode haver acesso ou não
    **/
    public static function checkAcess($caminho){
        $acessLevel = $_SESSION['acessLevel'];
        $caminho = \libs\kernel\path::dir().$caminho."/manifest.json";
        $autorizacao = explode(",",json_decode(file_get_contents($caminho))->acessLevel); //autorizações da página acessada
        if (in_array($acessLevel, $autorizacao)) return true;
        return false;
    }

    /**
     * esse metodo verifica quais as pastas (zonAS) proibidas pelo sistema, ou seja
     * que necessitam autenticação.. caso não queria que ele verifique... só proiba
     * coloqye a flag como false
     * */
    public static function filterRoutes($check=true, $path=""){
        $Protects = array( // futuramente essas permissões seram em um arquivo separado ou no esquema no manifest.json -- obs: essa são permissoes de altenticação de pacote, não de modulo
            'admin'
        );

        //flag para poder ele verificar ou não as zonas proibidas
        if($check){
            foreach($Protects as $p)
                if( $p == $path )
                    return true;
        }else{
            return true;
        }

        return false;

    }
}