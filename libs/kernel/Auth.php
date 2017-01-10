<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 13/10/16
 * Time: 22:26
 */

namespace libs\kernel;


class Auth
{
    /**
     * adicionando informacões de ussuário
    **/
    public static function setUser($array)
    {
        try{
            if(session_status() == PHP_SESSION_ACTIVE and is_array($array)){
                $_SESSION['user'] = $array;
                $_SESSION['user']['actived'] = true;
            }
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

    /**
     * removendo informações de sessão do usuario
    **/
    public static function remove()
    {
        try{
            unset($_SESSION);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * verificador para saber se esta ativo ou não o ususario
    **/
    public static function isActive()
    {
        try{

            if(session_status() == PHP_SESSION_ACTIVE and isset($_SESSION['user']['actived']))
                return $_SESSION['user']['actived'];
            else
                return false;

        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }


    /**
     * pegando as informações do ussuario qeu foram guardados
    **/
    public static function getUser()
    {
        try{
            if(session_status() == PHP_SESSION_ACTIVE)
                return $_SESSION['user'];
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}