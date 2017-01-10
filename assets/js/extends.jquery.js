$(function(){

    // preload de imagem
    $.fn.imgShow = function(){
        $(this.selector).on("change", function(evt){
            var files = evt.target.files; // lista de arquivos
            // a tag img que possui a classe imagem-slide vai receber a imagem que foi update
            $('.imagem-show').attr("src", URL.createObjectURL(event.target.files[0]));

        });
    };

    $.fn.imgBG = function(selector){
        $(this.selector).on("change", function(evt){
            var files = evt.target.files; // lista de arquivos
            // a tag img que possui a classe imagem-slide vai receber a imagem que foi update
            console.log(selector);
            $(selector).css({background: "linear-gradient(rgba(1,1,1, 0.4), rgba(1,1,1, 0.4)), url("+URL.createObjectURL(event.target.files[0])+") center / cover"});
        });
    };

    /**
     * o search busca por qualquer coisa onde vc quiser
     * ou seja ele busca um termo .. ele pega uma informação
     * de um imput e manda para um arquivo informado e depois ele
     * retorna um json.
     *
     * Como funciona?
     *
     * $(seletor): onde estará o input que sera pego o texto
     * .search(url): para onde será enviado o texto e retrnará oq ue o arquivo mandar, mas por default deve ser um json.
     *
     * exemplo: $(seletor).search(url) :: return json;
     *
     * **/

    $.fn.searchWord = function(url, callback){

        $(this.selector).on("keyup", function(){
            $.ajax({
                url: url,
                type: 'post',
                data:  'search='+$(this).val(),
                datatype: 'json',
                success: function(e){
                    //console.log(e);
                    $.each(JSON.parse(e), function(a, b){
                        callback.call(a,b);
                    });
                },
                error: function(e){
                    console.log("Error ao comunicar com o servidor");
                }
            });
        });
    };


    // preload de musicas
    $.fn.music = function(a){
        $(this.selector).on("change", function(evt){
            var files = evt.target.files; // lista de arquivos
            // a tag img que possui a classe imagem-slide vai receber a imagem que foi update
            a.src = URL.createObjectURL(event.target.files[0]);
            a.play();
        });
    };

    // preload de imagem
    $.fn.countDays = function(date){
        now = new Date();
        $date = [now.getDate(), now.getMonth()+1, now.getFullYear()];

        $d = date.split('/');
        $d2 = $date;
        $days = 0;

        while(true){
            if($d[0] < 31){
                $d[0]++;
            }else{
                if($d[1] <= 12){
                    $d[1]++;
                    $d[0] = 1;
                }else{
                    if($d[2] <= $d2[2]){
                        $d[2]++;
                        $d[1] = 1;
                    }else{
                        return 0;
                    }

                }
            }

            $days++;
            if(($d[0]==$d2[0]) && ($d[1]==$d2[1]) && ($d[2]==$d2[2])){
                return $days;
            }

        }
    };

});
