<?php
/*
 * criar log de linhas modificadas.
 */
namespace libs;

class autoUpdate{
    // lista de pastas que o auto update não vai verificar
    private static $badPath = ["Slim","modules"];
    private static $path = "configs/auto.update.xml";
    private static $list;


    public static function on(){
        self::config();
        self::copy();
    }

    public static function config(){
        if(!file_exists(self::$path))
            self::generateConfig();

        $data = self::scan();

        $dom = new \DOMDocument("1.0", "ISO-8859-1");
        $dom->load(self::$path);

        $path = new \DOMXPath($dom);
        $q = $path->query("/auto-update/file");

        //caso tenha algum arquivo novo ele atualiza a lista xml
        if($q->length != sizeof($data)) {
            self::generateConfig();
            self::config();
        }else{//verifica modificações nos arquivos
            foreach($q as $f){
                if($data[$f->childNodes[0]->nodeValue] != $f->childNodes[1]->nodeValue)
                    $list[] = $f->childNodes[0]->nodeValue;
            }

            //lista de arquivos modificados
           self::$list = $list;
        }
    }

    private static function scan(){
        $data = array();

        //lendo estrutura sofia
        foreach(scandir('.') as $k)
            if(($k != '.') && ($k != '..') && (!preg_match("/([.])/",$k)))
                if(array_search($k, self::$badPath) === false)
                    foreach(scandir($k) as $g)
                        if(($g != '.') && ($g != '..') && (preg_match("/([.])/",$g)))
                            $data[$k.'/'.$g] = filesize($k.'/'.$g);

        return $data;
    }

    public static function generateConfig(){
        $data = self::scan();

        //gerando o json
        $dom = new \DOMDocument("1.0", "ISO-8859-1");
        $root = $dom->createElement("auto-update");


        foreach($data as $k => $v){
            $child = $dom->createElement("file");
            $child->appendChild($dom->createElement("uri", $k));
            $child->appendChild($dom->createElement("size", $v));
            $root->appendChild($child);
        }

        $dom->appendChild($root);
        $dom->save(__dir__."/../configs/auto.update.xml");

    }

    public static function copy(){
        foreach(self::$list as $l){
            if(!file_exists(__dir__."/../configs/updates/".explode("/",$l)[0]))
                mkdir(__dir__."/../configs/updates/".explode("/",$l)[0],0777,true);


            if(!copy(__dir__."/../".$l,__dir__."/../configs/updates/".$l))
                return false;

            chmod (__dir__."/../configs/updates/".$l, 0777);
        }
    }
}