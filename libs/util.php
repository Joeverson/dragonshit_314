<?php
namespace libs;

class Util{
  public static $meses = array(
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
    public static function checkColunms($array1, $array2){
        if(!is_array($array2))
            $array2 = self::convertForArray($array2);

        $str = "Pensando...";

        foreach ($array1 as $key => $value) {
            if(!in_array($key, $array2))
                $str .= "<br> Não encontrei no segundo array a coluna: ".$key;
        }
        $str .='<br><br>';
        foreach ($array2 as $k => $value) {            
            if(!array_key_exists($value, $array1))
                $str .= "<br> Não encontrei no Primeiro array a coluna: ".$value;
        }

        //imprimindo os logs
        print $str;
    }

    private static function convertForArray($str){
        $arr = explode(",", $str);
        $a = array();

        foreach($arr as $v){
            $a[] = $v;
        }

        return $a;
    }

    /**
     * função para converter caracteres especias par utf8 onde ele recebe um array e corrige a codi-
     * ficação basta passar o array e ele vai procurar e alterar caso necessario.
     *
     * ::flags::
     * caso sejá só um nome então ativa a flag para 'true' ame $only, onde
     * esse only é um string.
     *
     * fonte :: http://nazcalabs.com/blog/convert-php-array-to-utf8-recursively/
     * */
    public static function utf8_converter($array, $only=false){

        if($array == false)
            return $array;
        if($only)
            utf8_encode($array);
        else{
            array_walk_recursive($array, function(&$item, $key){
                if(!mb_detect_encoding($item, 'utf-8', true)){
                    $item = utf8_encode($item);
                }
            });
        }

        return $array;
    }
}
