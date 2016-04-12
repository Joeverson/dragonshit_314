<?php
$action  = new \libs\functions;
$endereco = $action->urlPath();
$site = $action->urlSite();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Multiplicador - Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--link global-->
    <link href="<?=$endereco ?>admin/includes/css/material.min.css" rel="stylesheet">
    <link href="<?=$endereco ?>includes/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$endereco ?>admin/includes/css/basic.css" rel="stylesheet">
    <link href="<?=$endereco ?>admin/includes/css/clndr.css" rel="stylesheet">
    <link href="<?=$endereco ?>admin/includes/css/jqvmap.css" rel="stylesheet">
    <link href="<?=$endereco ?>admin/includes/css/nav.css" rel="stylesheet">
    <link href="<?=$endereco ?>admin/includes/css/jquery.dataTables.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/redmond/jquery-ui.css">
    <!-- link especifico -->
    <link href="<?=$endereco ?>admin/includes/css/style.css" rel="stylesheet">


    <!--script src="<?=$endereco ?>includes/js/tynimce.min.js"></script-->
    <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
    <script src="<?=$endereco ?>includes/js/jquery-1.10.1.min.js"></script>
    <!--script src="http://code.jquery.com/jquery-1.12.0.min.js"></script-->
    <!--script src="<?=$endereco ?>admin/includes/js/material.min.js"></script-->
    <script src="<?=$endereco ?>includes/js/extends.jquery.js"></script>
    <script src="<?=$endereco ?>includes/js/requests.ajax.js"></script>
    <script src="<?=$endereco ?>includes/js/bootstrap.min.js"></script>
    <script src="<?=$endereco ?>admin/includes/js/Chart.js"></script>
    <script src="<?=$endereco ?>admin/includes/js/Chart.HorizontalBar.js"></script>
    <script src="<?=$endereco ?>admin/includes/js/clndr.js"></script>
    <script src="<?=$endereco ?>includes/js/cms.notifications.js"></script>

    <script src="<?=$endereco ?>admin/includes/js/jquery.circlechart.js"></script>
    <script src="<?=$endereco ?>includes/js/jquery.dataTables.min.js"></script>
    <script src="<?=$endereco ?>includes/js/anmer.js"></script>

    <script src="<?=$endereco ?>includes/js/dataTables.bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

    <!-- formatando varios tipos de dados -->
    <!-- link tutorial: https://github.com/Qcabeca/mascara-jquery-no-input/blob/master/mascara.php -->

    <script type="text/javascript" src="<?=$endereco ?>includes/js/jquery.maskedinput.js"></script>
    <!-- CHAMANDO O MASKMONEY.JS | CASO NÃO VÁ FORMATAR VALORES (R$) RETIRE ESSE PLUGIN -->
    <script type="text/javascript" src="<?=$endereco ?>includes/js/jquery.maskMoney.min.js"></script>

    <script>
        $(function(){
            var tamanho;

            if($(document).height() < $(window).height())
                tamanho = $(window).height();
            else
                tamanho = $(document).height();

            //ajeitando o height da tela, já que o material, não ta ropdando.(pq tirei conflito com tynmce)
            $(".mdl-layout").css({height:tamanho});
        });
    </script>
    <style>
        body{
            font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }
    </style>
</head>
