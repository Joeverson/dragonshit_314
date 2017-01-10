<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 05/09/16
 * Time: 19:42
 */

namespace libs\database;
use libs\database\DB;

class Migrations
{
    private static $entity;

    /**
     * metodo responsavel por pegar todas as informações dos models
    **/
    private static function scan()
    {
        foreach(scandir(__dir__.'/../../modules') as $k)
            if(($k != '.') && ($k != '..')) {

                if( strpos($k,'_') === 0)
                    continue;

                if(preg_match('/\./',$k) === 0){
                    try{
                        $class = "\\modules\\".$k."\\model\\".ucfirst($k)."s";

                        if (!is_callable(array($class, "create"))) //verificando se pode migrar
                            continue;

                        self::$entity[$k] = call_user_func_array(array($class, "create"), array()); //preparando as informações para criar as entidades
                    }catch (\Exception $e){
                        print "houve algum problema ao ler as entidades";
                    }
                }
            }
    }


    /**
     * prepara a criação ou atualização de tabela do banco de dados usando as informações do model
    **/
    public static function run(){
        self::scan();//scaneando os models
        //var_dump(self::$entity);

        foreach (self::$entity as $en=>$col){
            $table = "CREATE TABLE ".$en." ( ";
            $table .= " id int not null auto_increment,";

            foreach ($col as $name=>$type){
                if($name == "update_at")
                    $table .= "update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,";
                else
                    $table .= $name." ".$type.",";
            }

            $table .= "PRIMARY KEY(id) );";

            //persistindo no banco de dados
            if(DB::instance()->query($table)===false){
                //pegando indormações do banco sobre a tabela
                $countDB = DB::instance()->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = '".trim($_ENV[$_ENV['RUN_DB']]['DB_NAME'])."' AND table_name = '".$en."';")->fetchAll();

                //limpando array que vem do banco de dados
                $baseDB = [];
                foreach ($countDB as $a => $b){
                    $baseDB[$b["COLUMN_NAME"]] = "";
                }

                //array com as nocas colunas a serem inseridas
                //verificada por comparação, no caso só adiciona não remove nenhuma não por motivos de segurança
                $updateTable = array_diff_key($col, $baseDB);

                if(!empty($updateTable)){ // adicionando as alterações
                    foreach ($updateTable as $colunAdd => $typeAdd){
                        //print "ALTER TABLE ".trim($_ENV[$_ENV['RUN_DB']]['DB_NAME'])." ADD ".$colunAdd." ".$typeAdd." ;";
                        DB::instance()->query("ALTER TABLE ".$en." ADD ".$colunAdd." ".$typeAdd." ;");
                    }
                }

            }

            print "<< Table -> ".$en." <- migrada com sucesso!!\n";

        }

        
    }
}