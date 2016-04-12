$(function(){

    //formulario de edição de usuario
    $("#formEditUser").on("submit",function(){
        event.preventDefault();
        var url = $(".urlForm").data('url'); // define para onde vai o post
        var redirect = $(".urlForm").data('redirect'); // define para onde vai depois que enviar o post
        var consoleN = $(".urlForm").data('console'); // usado só para testes para jogar no console o que retona
        var redirectthis = $(".urlForm").data('redirectthis'); // define se vai só recarregar a pagina
        var msg = $(".urlForm").data('msg'); // define que vai ouvir e interpretar as mesagens que vem


        $.ajax({
            url: url,
            type: 'post',
            data:  $("form").serialize(),
            datatype: 'html',
            beforeSend: function(){
                $('.progress-bar').show();
            },
            complete: function() {
                $('.progress-bar').fadeOut();
            },
            success: function(e){
                //notification.ok(e);

                if(redirect != undefined){
                    window.location.href = redirect;
                }else if(consoleN != undefined){
                    console.log(e);
                }else if(redirectthis != undefined){
                    window.location.href = url;
                }else if(msg != undefined){
                    console.log(JSON.parse(e));
                    if(redirect != undefined)
                        anmer.analise(JSON.parse(e), redirect);
                    else if(redirectthis != undefined)
                        anmer.analise(JSON.parse(e), redirectthis);
                    else
                        anmer.analise(JSON.parse(e));
                }else{
                    window.location.reload();

                }
            },
            error: function(e){
                console.log(e);
                notification.error(e);
            }
        });
    });

    //pedidos de modal generico - carregar conteudo no modal

    $(".fn").on("click", function(){
        var url = $(this).data('url');
        var title = $(this).data('title');
        var id = $(this).data('id');


        $.ajax({
            url: url,
            type: 'post',
            data: "id="+id,
            datatype: 'html',
            beforeSend: function(){
                //$('.progress-bar').show();
            },
            complete: function() {
                //$('.progress-bar').fadeOut();
            },
            success: function(e){
                $('.modal-title').html(title);
                $('.modal-body').html(e);
                $('#modalUses').modal('show');
            }
        });
    });


    /*
     ajax de serviço, usado para mandar mensagens para algum arquivo php ou ate mesmo um arquivo de configuração,
     //.. este ajax é mais para enviar uma mensagem para alguem, ele possue alguns parametros:

     ##lembrando que os 'data' são os atributos que seram colocados na tag html que vc deseja que seje que envie.

     data-url [obrigatorio] => que recebe qual arquivo ou sistema que irá receber a mensagem
     data-msg [obrigatorio] => onde esta esta a mensagem que irá ser enviada para o desino informado no data-url
     data-notification [opcional] => recebe a mensagem que deseja apresentar, ele ira notificar uma tela de sucesso para a mensagem enviada
     data-reload [opcional] => recebe true or false, ele ira recarregar a pagina apois o envio da mensagem.

     .::logica::.

     a tag ou btn, que vc deseje que envie a mensagem deve conter a class 'send-msg' e os atributos 'data'
     para a configuração correta do envio ajax.

     ele envia a mensagem assim qeu for clicado na tag ou btn que esta com a classe e os atributos.

      */

    $(".send-msg").on("click", function(){
        var url = $(this).data('url');
        var msg = $(this).data('msg');
        var id = $(this).data('id');
        var reload = $(this).data('reload');
        var notification  = $(this).data('notification');


        $.ajax({
            url: url,
            type: 'post',
            data: "msg="+msg+"&id="+id,
            datatype: 'html',
            beforeSend: function(){
                //$('.progress-bar').show();
            },
            complete: function() {
                //$('.progress-bar').fadeOut();
            },
            success: function(e){
                console.log(e);

                if(notification !== undefined)
                    notification.ok(notification);

                if(reload !== undefined)
                    window.location.reload();
            }
        });
    });

});
