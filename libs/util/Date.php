<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/21/16
 * Time: 11:52 AM
 *
 * classe responsavel por manipular com datas de forma geral
 */

namespace libs\util;


class date{

    /**
     * disponibilização de valores do mes onde se diz o dia e ele retorna a
     * string do mes.....
    **/
    public static $MOUNTH = array(
        "01" => 'Janeiro',
        "02" => 'Fevereiro',
        "03" => 'Março',
        "04" => 'Abril',
        "05" => 'Maio',
        "06" => 'Junho',
        "07" => 'Julho',
        "08" => 'Agosto',
        "09" => 'Setembro',
        "10" => 'Outubro',
        "11" => 'Novembro',
        "12" => 'Dezembro'
    );

    /**
     * função para formatar o timestamp do bando de dados, ela reebe uma parametro extra caso deseje saber quantos
     * dias se passaram entre duas datas...
     * - se quiser só formatar apenas passe a data em formato timestamp do DB
     * - mas caso queira que apenas retorne a qantidade de dias corrido, passe a data e true
     *
     **/
    public static function dateTimeStampConsertAndOrganize($str, $timeCurrent=false){
        $strs = explode(" ", $str);
        $date = explode("-", $strs[0]);

        if($timeCurrent)
            return $date[2];

        if(@$date[2] == "00" or $date[0] == "0000" or $str === NULL)
            return "---";

        return $date[2]."/".$date[1]."/".$date[0];
    }


    /**
     * esse metodo retorna a data em fragmentos onde pode ser dia/ano, dia/mes, ...
     *
     * basta dizer como a mascara deve ser onde "d" <- dia -- "m" <- mes "y" <- ano
     *
     * flag:: se o nameMounth for true ele devolve o mes como o nome dele.
    **/
    public static function dateTimeStampFragmentOrganize($str, $mask, $nameMounth=false){
        $strs = explode(" ", $str);
        $date = explode("-", $strs[0]);


        if(@$date[2] == "00" or $date[0] == "0000" or $str === NULL)
            return "---";

        $m = explode("/",$mask);

        $return = array();

        foreach($m as $kk){
            if($kk == "d"){
                $return[] = $date[2];
            }else if($kk == "m"){
                //aplicando a flag
                if($nameMounth)
                    $return[] = self::$MOUNTH[$date[1]];
                else
                    $return[] = $date[1];
            }else if($kk == "y"){
                $return[] = $date[0];
            }
        }


        return implode('/', $return);

    }

    /**
     * essa função é responsavel para incrementar os dias onde ele recebe um inteiro
     * que é a quantidades de dias que ele vai analizar, e retorna a data com os
     * dias adicionados.
     *
     * a data passada deve ser em formato yyyy-mm-dd
     **/
    public static function alterDateByDays($days = 0, $date = false){
        if($date != false)
            $d = explode('-', $date);
        else
            $d = explode('-', date("Y-m-d"));

        return date("Y-m-d", mktime(0, 0, 0, $d[1], ($d[2] + $days), $d[0]));
    }

    /**
     * esse metodo é resonsavel por converter uma data do tipo "dd/mm/yyyy" para
     * timestamp
    **/
    public static function timestampConvert($date){
        $d = explode('/', $date);
        return mktime(0, 0, 0, $d[1], $d[0], $d[2]);
    }


    /**
     * contador de dias, ele recebe uma data no formato dd/mm/yyy e conta quandos dias
     * se passaram em relação a data atual do sistema.
    */
    public static function countDays($date){

        $d = explode('/', $date);
        $d2 = explode('/', date('d/m/Y'));
        $ini = mktime(0, 0, 0, $d[1], $d[0], $d[2]);
        $fin = mktime(0, 0, 0, $d2[1], $d2[0], $d2[2]);

        // Calcula a diferença de segundos entre as duas datas:
        $count = $fin - $ini;

        // Calcula a diferença de dias
        return (int)floor( abs($count / (60 * 60 * 24))); // 225 dias

    }
}