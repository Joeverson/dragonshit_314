<?php
$action  = new \libs\functions;
$endereco = $action->urlPath();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>SSDigital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="<?=$endereco ?>includes/js/jquery-1.10.1.min.js"></script>
    <script src="<?=$endereco ?>admin/includes/js/material.min.js"></script>
    <script src="<?=$endereco ?>includes/js/extends.jquery.js"></script>
    <script src="<?=$endereco ?>includes/js/requests.ajax.js"></script>
    <script src="<?=$endereco ?>includes/js/rosa.notification.js"></script>
    <script src="<?=$endereco ?>includes/js/bootstrap.min.js"></script>

    <!--link global-->
    <link href="<?=$endereco ?>admin/includes/css/material.min.css" rel="stylesheet">
    <link href="<?=$endereco ?>includes/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- link especifico -->
    <link href="<?=$endereco ?>admin/includes/css/style.css" rel="stylesheet">



</head>

