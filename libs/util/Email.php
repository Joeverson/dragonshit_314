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
    private static $message;
    private static $subject;
    private static $header;

    public static function prepare($from, $subject, $message, $to=null){
        // O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
        // O return-path deve ser ser o mesmo e-mail do remetente.
        self::$header = "MIME-Version: 1.1\n";
        self::$header .= "Content-type: text/html; charset=iso-8859-1\n";
        self::$header .= "From: ".$from."\n"; // remetente
        self::$header .= "Return-Path: ".$from."\n"; // return-path
        self::$header .= "Cc: ".EMAIL." \n";

        if($to == null)
            self::$header .= "Reply-To: ".EMAIL."\n"; // return-path
        else
            self::$header .= "Reply-To: ".$to."\n"; // return-path

       self::$to = $to;
       self::$message = $message;
       self::$subject = $subject;
    }
    /**
    a flag e responsavel por mostrar ou não as notiifcações
    **/
    public static function send($noFeedback = false)
	{
		$msgErro = array("type"=>"error" , "message" => "Houve um problema ao enviar o email, tente novamente.");
		$msgOk   = array("type"=>"success" , "message" => "Mensagem foi enviada com sucesso!!");

        if(self::$to == null){
            $rsp = mail(EMAIL  , self::$subject, self::$message, self::$header);
            if($noFeedback and !$rsp) return $msgErro;
			else return $msgOk;

		}else{
           $resp = mail(self::$to  , self::$subject, self::$message, self::$header);

           if(!$resp and $noFeedback) return $msgErro;
		   else return $msgOk;
			}
		}
	}
