<?php
namespace libs\performace;

class timeHelper {
    private static $begin;
    private static $poins = array();

    public static function begin() {
        self::$begin = microtime(true);
    }

    public static function segundos() {
        return microtime(true) - self::$begin;
    }

    // quando vc coloca o end vc define uma tag para saber de onde é esse calc.. e ele mostra a tag com a
    // o valor de tempo que durou....
    public static function end($tag) {
        $segs = self::segundos();
        $dias = floor($segs / 86400);
        $segs -= $dias * 86400;
        $horas = floor($segs / 3600);
        $segs -= $horas * 3600;
        $minutos = floor($segs / 60);
        $segs -= $minutos * 60;
        $microsegs = ($segs - floor($segs)) * 1000;
        $segs = floor($segs);

        self::$poins[$tag] = (empty($dias) ? "" : $dias . "d ") .
                             (empty($horas) ? "" : $horas . "h ") .
                             (empty($minutos) ? "" : $minutos . "m ") . $segs . "s " . $microsegs . "ms";

    }

    /**ao informar a tag ele mostra o tempo que essa teg guardou
        ou seja, qunado vc demarca um trecho de script para ser analisado
        vc salva usando uma tag e pode acessar esse tempo atravez da tag
     */
    public static function point($tag){
        print self::$poins[$tag];
    }

    /**
     * recupera to.do o array de tags
     * */
    public static function allPoint(){
        return self::$poins;
    }

}