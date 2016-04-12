/**
 * Created by root on 3/29/16.
 *
 * essa API serve para analisar e execultar alguma ação generica prevista para o sistema
 * é usada mais comumente para envio de mensagens para o ajax enviadas pelo php.
 *
 * basta chamar e passar o json que vem do php e ele irá apresentar as mensagens necessarias assim
 * como passagem de mensagem pode ser usada. ver mais detarlhes em  (\Documentaçao\menssages.txt).
 */
var anmer = {
    "analise": function(json, url){
        switch(json.type){
            case "error":
                notification.error(json.message);
                break;
            case "success":
                notification.ok(json.message);
                setTimeout(function(){
                    if(url == undefined)
                        window.location.reload();
                    else
                        window.location.href = url;
                },3000);
                break;
            default:
                console.log("\nHouve algun erro no json, olha como ele ta vindo |\n\n");
                console.log(json);
                break;
        }
    }
};