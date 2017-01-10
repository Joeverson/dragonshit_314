# Sofia v2 - largart.beta
Framework de sistema web criado por:
```
joerverson.santos@gmail.com
```

# Pré-requisitos

- php 5.5
- composer
- npm

# Scope

__controller__

Possue o arquivo de rotas, responsavel para direcionar para os modulos.

__db__

Configurações padrões do banco de dados.

__modules__

Path responsavel por ficar os modulos do sistema, os modulos que o sistema irá trabalhar

__vendor__

lugar onde fica o slim micro framework e as libs usadas pelo sistema

# JSON
Para poder retronar um json devese ser implementado nos modulos a seguinte metodo, onde o
´$app´ é o objeto do container onde é possivel renderizar paginas.
´$response´ é as informações de resposata do servdor.
´$args´ são os argumentos que foram por parametro. 

```
    public function json($app, $response, $args){
        
    }
```


# Chamadas de renderização de paginas 
 [php-view](https://github.com/slimphp/PHP-View)
 
 com a renderização você pode usufruir do arquivo de layout da pagina 
 
 ```
 $app->view->render($response,"/user/index.php",["csda"=>1]);
 ```