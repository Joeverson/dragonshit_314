/**
 * Created by root on 4/11/16.
 */
$(function(){

    /**
     * removendo a tela de logon
     * **/

    $('body').removeClass("is-loading");

    /**
     * loading de uma bateria ^^
     * **/
    var icons = ['<i class="fa fa-battery-empty" aria-hidden="true"></i>',
    '<i class="fa fa-battery-quarter" aria-hidden="true"></i>',
    '<i class="fa fa-battery-half" aria-hidden="true"></i>',
    '<i class="fa fa-battery-three-quarters" aria-hidden="true"></i>',
    '<i class="fa fa-battery-full" aria-hidden="true"></i>'];

    var i = 0;
    setInterval(function(){
        $('.change-batery').html(icons[i]);
        if(i > 4){
            i = 0;
        }

        i++;
    }, 500);

});