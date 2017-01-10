/**
 *
 *  CPC - 0.1Beta
 *
 * O que Ã© CPC: Ã© uma tecnica de dar comando em texto e transformar esse comando em aÃ§Ã£o.
 Linguagem Implementada: JavaScript.
 Como Funciona: o usuario linka a pagina uma arquivo json com a seguinte estrutura
 var cpc = [
 {
 terms: '',
 category: '', // tipo do dado. categorya do tipo de aÃ§Ã£o
 actions: ''
 },
 {
 terms: '',
 actions: ''
 }
 ]

 o nomes terms e actons sÃ£o padroes onde terms Ã© a palavra que vai chamar a aÃ§Ã£o escrita abaixo..... por hora essa Ã© a estrutura usada no CPC-0.1Beta
 .. o usuario chama o plugin cpc e linka um arquivo com a estrutura acima e depois Ã© so instanciar a class cpc, na seguinte forma
 var nomequalquer = new cpc(variavel informada LÃ¡ Em Cima); e depois Ã© sÃ³ da 'on' .. ex: variavelqualquer.on(); agora sÃ³ digitar e o cpc irar
 agir quando for digitado o termo certo e dado enter.

 Requesitos:
 - Jquery


 Methods

 void on() - captura toda as teclas digitadas no site e se der enter ele ira verificar se existe algum termo correspondente.


 *
 * */

function cpc(json){
    this.s = '';

    this.on = function(){
        $(document).keydown(function(){
            var code = event.keyCode;
            this.s += String.fromCharCode(code);

            if(code == 13){ // quando dar enter ele vai ver o termo
                var nome = this.s.toLowerCase();
                json.forEach(function(a){
                    if(new RegExp(a.term).test(nome)){
                        a.action();
                    }
                });
                this.s = '';
            }
        });

    };
}

/**
 * rodando o cpc.
 * **/

var cpcs = new cpc(commands);
cpcs.on();
