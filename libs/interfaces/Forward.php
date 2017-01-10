<?php
/**
 * Created by PhpStorm.
 * User: joerverson barbosa santos
 * Date: 3/18/16
 * Time: 11:26 AM
 *
 * esta interface é para a implementação da logica de troca de serviços entre classes e ate atividades
 * durante a execução do softwere.
 *
 * ::: LOGICA :::
 *
 *  - uma classe especifica que queira disponibilizar um serviço que seja util para alguma outra classe
 *    ela deve implementar essa interface e implementar o metodo forward, ele recebe uma variavel mixed,
 *    ou seja, ele recebe um array com as informações que ele pode utilizar( as informações que ele ne-
 *    cessitar deverá ser infomada no comentario do implementação para facilicatar a vida do developer)
 *    .... a classe que implementa o metodo forward deverá retornar alguma coisa a classe que esta chamando-a
 *
 *todo não ah uma forma pensada de serviçoes multiplos que uma classe pode oferecer
 */

namespace libs\interfaces;


interface Forward
{
    /**
     * repassando responsabilidade de execução onde uma classe
     * especifica deve executar algum serviço implementado.
     **/
    public function forward($array);
}