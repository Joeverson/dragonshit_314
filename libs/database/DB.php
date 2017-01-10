<?php
namespace libs\database;
use \PDO;

class DB{
    private static $user;
    private static $pass;
    private static $host;
    private static $bdname;
    private static $socket;
    private static $conn = null;


    /**
     * conexão com o banco de dados usando o lessQL
     **/
    private static function conn(){
        try{

            //carregando as variaveis de ambiente de banco de dados
            \libs\kernel\System::loadConfigEnvDB();

            //preparando as informações para conectar o banco de dados
            foreach ($_ENV[$_ENV['RUN_DB']] as $item=>$env){
                $env = substr($env, 0, -1);

                switch ($item){
                    case "DB_SOCKET":
                        self::$socket = $env;
                        break;
                    case "DB_HOST":
                        self::$host = $env;
                        break;
                    case "DB_PASSWORD":
                        self::$pass = $env;
                        break;
                    case "DB_USER":
                        self::$user = $env;
                        break;
                    case "DB_NAME":
                        self::$bdname = $env;
                        break;
                }
            }


            self::$conn = new \medoo([  "database_type" => self::$socket,
                                        "server" => self::$host,
                                        "database_name" => self::$bdname,
                                        "username" => self::$user,
                                        "password" => self::$pass,
                                        "charset"=>"utf8",
                                        'port' => 3306,
                                    ]);

        }catch(\PDOException $e){
            echo "Deu algum erro na conexão - ".$e->getMessage();
        }

    }

    /**
     * capturando a instancia do banco de dados
    **/

    public static function instance(){
        if(self::$conn == null)
            self::conn();

        return self::$conn;
    }
}