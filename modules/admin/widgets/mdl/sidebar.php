<!--top menu-->
<!-- Uses a transparent header that draws on top of the layout's background -->
<style>
    .layout-transparent {
        background: linear-gradient(RGBA(28, 28, 28, 0.45), RGBA(28, 28, 28, 0.45)), url('https://38.media.tumblr.com/f19c59035b36d8ab68733ee4d821b999/tumblr_nv2bigIs9C1r85hlio1_r1_500.gif') center / cover;
    }
    .layout-transparent .mdl-layout__header,
    .layout-transparent .mdl-layout__drawer-button {
        background-color: RGBA(28, 28, 28, 0.2);
        color: white;
    }
</style>
<div class="layout-transparent mdl-layout mdl-js-layout">
    <header class="mdl-layout__header mdl-layout__header--transparent">
        <div class="mdl-layout__header-row">
            <!-- Title -->
            <span class="mdl-layout-title">
                <a href="<?= $endereco ?>../admin">
                    <img src="<?= $endereco ?>includes/img/logomarca.png" width="120" alt=""/>
                </a>
            </span>
            <!-- Add spacer, to align navigation to the right -->
            <div class="mdl-layout-spacer"></div>
            <!-- Navigation -->
            <nav class="mdl-navigation">
                <a class="mdl-navigation__link logout" href="<?=$endereco?>../logout">SAIR</a>
            </nav>
        </div>
    </header>
    <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">
            <a href="<?= $endereco ?>../admin">
                <img src="<?= $endereco ?>includes/img/logomarca.png" width="120" alt=""/>
            </a>
        </span>
        <nav class="mdl-navigation">
            <?php foreach($action->makeMenu() as $k){ ?>
                <?php if(!empty($k['submenu'])){?>
                    <!-- Left aligned menu below button -->
                    <button id="demo-menu-lower-left" class="mdl-button">
                        <?=$k['title']?>
                    </button>

                    <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-left">
                        <?php foreach($k['submenu'] as $v){?>
                            <li>
                                <a href="<?php if (!empty($v['url'])) echo $endereco.$v['url'] ?> " class="mdl-navigation__link"><?=$v['title']?></a>
                            </li>
                        <?php } ?>
                    </ul>
                <?php }else{?>
                    <a href="<?=$endereco.'../'.$k['url'] ?>" class="mdl-navigation__link link-pretty"><?=$k['title']?></a>
            <?php }
            }?>

            <nav class="mdl-navigation">
                <h5 class="text-center"><a class="logout" href="<?=$endereco?>../logout">SAIR</a></h5>
            </nav>
        </nav>
    </div>



