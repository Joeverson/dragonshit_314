<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/21/16
 * Time: 11:59 AM
 *
 * classe responsavel por criação e manipulações de elementos do sistema
 */

namespace libs\util;


class Generate{

    /**
     * este metodo e responsavel por gerar os menus atravez do manifest json
     */
    public static function makeMenu(){
        //$acessLevel = $_SESSION['acessLevel'];  //informação necessária para saber o nivel de acesso do usuário logado
        if(!empty($_SESSION['makeMenu'])) return $_SESSION['makeMenu'];
        $masters = array();

        foreach(scandir('modules') as $k)
            if(($k != '.') && ($k != '..') && (!preg_match("/([.])/",$k))) {
                $manifest = 'modules/' . $k . '/manifest.json';

                if (is_file($manifest)) {
                    $obj = json_decode(file_get_contents($manifest), true);

                    if ($obj['dad'] == "this") {
                        if (!empty($obj['acessLevel']) || $obj['acessLevel'] == "0"){
                            $array = explode(",", $obj['acessLevel']);
                            foreach($array as $vl){

                                    $masters[$obj['title']] = $obj;
                                    $masters[$obj['title']]['acessLevel'] = $array;
                                    continue;
                            }
                        }else{
                            //$masters[$obj['title']] = $obj;
                        }
                    } else {
                        $subs[$obj['dad']] = $obj;
                    }
                }
            }

        if(!empty($subs)){
            foreach ($subs as $sub){
                foreach($sub['submenu'] as $s)
                    $masters[$sub['dad']]['submenu'][] = $s;
            }
        }

        //return $_SESSION["makeMenu"] = $masters;
        return $masters;
    }
}
