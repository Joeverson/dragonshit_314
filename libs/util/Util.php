<?php
/**
 * Classe responsavel de por utilidades gerais do sistema
 *
 * @author joerverson <joerverson.santos@gmail.com>
 * @category utilidades
 * @version 0.1
 * @copyright GPL © 2016, PJI.
 * @access public
 * @example Classe Util.
 * @package libs\util
 */

namespace libs\util;


class Util
{
    /**
     * prepara um array para ser inserido em um query usando PDO, e tem uma flag que se for falso ele não
     * ignora campos vazios.
     *
     *
     *
     *
     * @param String[] $array informações que devem ser tratadas para trocar para uso padrão do PDO ou seja adicianando os ":" nas keys do array
     * @param boolean $flag ele define se for excluir as informações estão ou não vazios, caso esteja true ele remove
     * os valores vazios, caso false ela ele ignora os campos vazios no array.
     * @return String[] $newArray retorna o novo array preparado para usar no PDO.
     */
    public static function prepareArrayDoublePointer($array, $flag = true){
        $newArray = array();

        if(!is_array($array) || empty($array))
            return null;

        foreach($array as $key => $val){
            if( $val == "" and $flag) continue;
            if( $key == 'pass' ){
                $newArray[':'.$key] = \libs\kernel\Security::segPassEncript($val);
                continue;
            }

            $newArray[':'.$key] = $val;
        }

        return $newArray;
    }

    /**
    essa função pega o id do multiplicador, mesmo se for ele mesmo ele retorna o id do dono geral
     * ele recebe a sessão de usuario, ou oobjeto ususario e descobre se ele é o multiplicador, se não ele pega
     * o seu multiplicador
     **/
    public static function getIdMultiplicador($user){
        $dbUser = new \modules\admin\user\models\DBUser;
        $id = "";

        if($user['cod_multiplicador'] == 0)
            $id = $dbUser->selectUser($user['id_multiplicador'])['cod_multiplicador'];
        else
            $id = $user['cod_multiplicador'];

        return $id;
    }


    /**
    *esse metodo é para pegar o id do usuario logado idependentemente se ele é ou não o multiplicador
    *@return int $id retorna o id do usuario corrente
    **/
    public static function myIdUser(){
      return $_SESSION["user"]['id_multiplicador']==0?$_SESSION["user"]['id_user']:$_SESSION["user"]['id_multiplicador'];
    }

    /**
    função criaad por: Ghanshyam Katriya
    esse emtodo e usado para fazer com que um array seja limpo de duplicações

    @param mixed[] $array array inicial que contem as duplicacoes
    @param string $key esta é a chave do array qeus será feita a limpeza

    @return mixed[] $temp_array novo array limpo sem duplicações
    **/

    function uniqueMultiArray($array, $key) {
    $temp_array = array();
    $i = 0;
    $key_array = array();

    foreach($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
  }
    
    /**
     * esse metodo e responsavel por pegar o tipo de usuario que esta logado correntemente
     * mas ele possue uma peculiaidade já como em algumas paginas o acesso ao objeto
     * e complicado pois a sessão não tem acesso .. esse metodo vai ser usado com um pote
     * onde vai ser colocado o id_tipo do usuarrio ou pego direto da sessão
     * 
     * @param int $setId int caso a sessão não funcione ele irá usar esse valor como o valor
     * do tipo do usuário
    **/
    
    public static function getIdTypeUser($setId=null){
        if(isset($_SESSION['user']))
            return $setId;
        else
            return $_SESSION['user']['id_tipo'];
    }

    /**
     * metodo responsavel por converter um array em string e depois decodificar
     * o array deve ser apenas normal , nada de bidimencional
     * 
     * todo pode haver o problema da string haver os caracteres especiais '¬' ou ':'
     * 
     * caracteres especias ':' onde a esquerda fica a chave e a direita o valor
     * '¬' separa entre os valores no array
     * 
     * @param mixed[] $array array para ser codificado em string
     * 
     * @return string $str string codificada do array 
    **/

    public static function array_encode_string($array){
        try{
            $str = "";
            
            foreach ($array as $a => $v){
                $str .= $a.":".$v."->";
            }
            
            return substr($str, 0, -2);
        }catch(\Exception $e){
            print "Erro ao codificar o array para string {sem suporte para array bidimencional}";
        }
    }
    
    /**
     * metodo responsavel por pegar uma string codificada para array.. só funciona se ele tiver sido
     * codificada pela irmã dela..
     *
     * @param string $str string codificada para transformar no array
     *
     * @return mixed[] $array array para ser decodificado para array
    **/
    public static function array_decode_string($str){
        try{
            $array = array();

            foreach(explode("-", $str) as $its){
                $val = explode(":", $its);
                $array[$val[0]] = $val[1];
            }

            return $array;
        }catch(\Exception $e){
            print "Erro ao decodificar, talvez a string não foi codificada pela função [array_encode_string]";
        }
    }
}
