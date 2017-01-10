<!DOCTYPE HTML>
<!--
	Identity by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
    <title>DragonShit</title>
    <link rel="icon"  type="image/png" href="<?=libs\kernel\path::assets('iena.png')?>">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="<?=libs\kernel\path::path()?>login/assets/js/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="<?=libs\kernel\path::path()?>login/assets/css/main.css" />

    <link rel="stylesheet" href="<?=libs\kernel\path::assets('mdl/material.min.css')?>" />
    <!--link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


    <!--link rel="stylesheet" href="<?=\libs\kernel\path::path()?>admin/includes/css/material.min.css" /-->
    <!--[if lte IE 9]><link rel="stylesheet" href="<?=libs\kernel\path::path()?>login/assets/css/ie9.css" /><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" href="<?=libs\kernel\path::path()?>login/assets/css/ie8.css" /><![endif]-->
    <noscript><link rel="stylesheet" href="<?=libs\kernel\path::path()?>login/assets/css/noscript.css" /></noscript>
    <script src="<?=\libs\kernel\path::path()?>login/assets/js/jquery.js"></script>

    <script src="<?=\libs\kernel\path::assets('mdl/material.min.js')?>"></script>

    <script src="<?=\libs\kernel\path::path()?>login/assets/js/funnny.js"></script>
    <script src="<?=\libs\kernel\path::assets('js/commands.js')?>"></script>
    <script src="<?=\libs\kernel\path::assets('js/cpc.js')?>"></script>
    <script src="<?=\libs\kernel\path::assets('js/cms.notifications.js')?>"></script>

</head>
<body class="is-loading">
<div class="demo-layout-transparent mdl-layout mdl-js-layout">

    <?php if(libs\kernel\Auth::isActive()){?>
        <header class="mdl-layout__header mdl-layout__header--transparent">
            <div class="mdl-layout__header-row">
                <!-- Title -->
                <span class="mdl-layout-title">
                <img src="<?=\libs\kernel\path::assets('bulll.png')?>" alt="" width="50"/>
            </span>
                <!-- Add spacer, to align navigation to the right -->
                <div class="mdl-layout-spacer"></div>
                <!-- Navigation -->
                <!--nav class="mdl-navigation">
                    <a class="mdl-navigation__link" href="">Link</a>
                    <a class="mdl-navigation__link" href="">Link</a>
                    <a class="mdl-navigation__link" href="">Link</a>
                    <a class="mdl-navigation__link" href="">Link</a>
                </nav-->
            </div>
        </header>
        <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">
            <img src="<?=\libs\kernel\path::assets('bulll.png')?>" alt="" width="50"/>
        </span>
            <nav class="mdl-navigation">
                <?php foreach (\libs\util\Generate::makeMenu() as $it){?>
                    <a class="mdl-navigation__link" href="<?=libs\kernel\path::site()?><?=$it['url']?>"><?=$it['title']?></a>
                <?php } ?>
            </nav>
        </div>
    <?php }?>

    <main class="mdl-layout__content">
    <?=$render_content?>
    </main>
</div>
</body>
</html>
