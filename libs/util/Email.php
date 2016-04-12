<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/29/16
 * Time: 9:10 AM
 *
 * essa classe é responsavel por preparar os emails e evia-los
 *para onde quiser ;)
 */

namespace libs\util;

//definindo constante email;
define("EMAIL","atendimento@multiplicadoronline.com.br");

class Email
{
    private static $to;
    private static $messager;
    private static $subject;
    private static $header;



    public static function prepare($from, $subject, $messager, $to=null){
        // O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
        // O return-path deve ser ser o mesmo e-mail do remetente.
        self::$header = "MIME-Version: 1.1\n";
        self::$header .= "Content-type: text/html; charset=iso-8859-1\n";
        self::$header .= "From: ".$from."\n"; // remetente
        self::$header .= "Return-Path: ".$from."\n"; // return-path

        if($to == null)
            self::$header .= "Reply-To: ".EMAIL."\n"; // return-path
        else
            self::$header .= "Reply-To: ".$to."\n"; // return-path

        self::$to;
        self::$messager;
        self::$subject;
    }

    public static function send(){
        if(self::$to == null)
            if(!mail(EMAIL  , self::$subject, self::$messager, self::$header))
                print json_encode(array("type"=>"error" , "message" => "Houve um problema ao enviar o email, tente novamente."));
            else
                print json_encode(array("type"=>"success" , "message" => "Mensagem foi enviada com sucesso!!"));
        else
            if(!mail(self::$to  , self::$subject, self::$messager, "From:".self::$header))
                print json_encode(array("type"=>"error" , "message" => "Houve um problema ao enviar o email, tente novamente."));
            else
                print json_encode(array("type"=>"success" , "message" => "Mensagem foi enviada com sucesso!!"));

    }
}