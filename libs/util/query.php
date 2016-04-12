<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/21/16
 * Time: 11:59 AM
 *
 * classe responsavel por criação e emanipulação de querys PDO
 */

namespace libs\util;


class query{

    /**
    * esse metodo gera um query update para passar para o pdo ou para qualquer
    * lugar.
    * atributos que o metodo recebe:
    * $table => tabela que deseja atualizar
    * $array => dados que iram ser atualizados onde a chave e o coluna e o valor e o valor kk
    * $id => id que ira identificar a tupla para ser atualizada
    * $where=> condiçao para ser buscado junto com $id ex: $where = $id;
    * $count=> recebe true of false caso queira que ele traga a quantidade de linhas
    */
    public static function generateQuerySqlSelectPDO($table, $array, $id, $where, $count=false){

        if($count)
            $str = "SELECT count(*) as count FROM ".$table;
        else
            $str = "SELECT * FROM ".$table;

        $date = '';
        $filter = '';
        $dimensoes = '';

        foreach($array as $key => $val){

            //vendo se tem data e ajeitando
            if (preg_match('/^periodo:/',$key)){
                if($val == 0 or $val == '') continue;

                //tirando a flag inicial onde indentifica de onde vem essa informação.
                $key = substr($key, 8);

                //preparando a parte da query que irá fazer busca por data.. a where no caso (parte dela)
                if($key == "anual") $date .= "ANO_REF = ".substr($val, 2);
                else if ($key == "ANO_REF") $date .= $key." = ".substr($val, 2)." and ";
                else if ($key == "MES_REF") $date .= $key." = ".$val;
                else if ($key == "pre-definido") $date .= "DATA_FORMALIZACAO BETWEEN \"".date("Y-m-d")."\" AND \"". \libs\util\Date::alterDateByDays(30*$val)."\"";
                else if ($key == "date-ini") $date .= "DATA_FORMALIZACAO BETWEEN \"".$val."\"";
                else if ($key == "date-fin") $date .= " AND \"".$val."\"";

            }else if(preg_match('/^filtro:/',$key)){
                if($val == 0 or $val == '') continue;

                //tirando a flag inicial onde indentifica de onde vem essa informação.
                $key = substr($key, 7);

                //preparando a parte da query que irá fazer busca filtros
                if($key == "agencias"){
                    foreach($val as $o => $b){
                        if($o == 0)
                            $filter .= "AGENCIA = ".$b." ";
                        else
                            $filter .= "and AGENCIA = ".$b." ";
                    }
                }
                else if ($key == "correspondentes"){
                    foreach($val as $l => $p){
                        if($l == 0)
                            $filter .= " CHAVE_LOJA = ".$p." ";
                        else
                            $filter .= "and CHAVE_LOJA = ".$p." ";
                    }
                }
            }
        }

        //verificando se esta vazio, se não ele vai adicionar um "and" para a query não de erro.
        //ends finais das querys
        if($date != "") $date .= " and ";
        if($filter != "") $filter .= " and ";


        $str .= " WHERE ".$date." ".$filter." ".$where." = '$id'";


        return $str;
    }

    /**
     * esse metodo gera um query update para passar para o pdo ou para qualquer
     * lugar.
     * atributos que o metodo recebe:
     * $table => tabela que deseja atualizar
     * $array => dados que iram ser atualizados onde a chave e o coluna e o valor e o valor kk
     * $id => id que ira identificar a tupla para ser atualizada
     * $where=> condiçao para ser buscado junto com $id ex: $where = $id;
     */
    public static function generateQuerySqlUpdatePDO($table, $array, $id, $where){

        $str = "UPDATE ".$table." SET";
        unset($array['id_user']);

        foreach($array as $key => $val){
            if($val == '' || $key == "id_user") continue;


            if(end($array) == $val)
                $str .= " $key = '".$val."' ";
            else
                $str .= " $key = '".$val."', ";
        }

        //corrigindo vesdigiso de ','
        $s = explode(",", $str);

        if(end($s) == " ")
            array_pop($s);

        $str = implode(",", $s);

        //finalizando query
        $str .= " WHERE ".$where." = '$id'";

        return $str;
    }
}