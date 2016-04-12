<?php
?>

<!-- Sidebar -->
<nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
    <ul class="nav sidebar-nav">
        <li class="sidebar-brand">
            <a href="#">
                MENU
            </a>
        </li>
        <?php foreach($action->makeMenu() as $k){ ?>
            <li>
                <a href="<?=$k['url'] ?>" class="title"><?=$k['title']?></a>
            <?php foreach($k['submenu'] as $v){?>
                <li>
                    <a href="<?php if (!empty($v['url'])) echo $endereco.$v['url'] ?> " data-toggle="offcanvas"><?=$v['title']?></a>
                </li>
            <?}?>

            </li>
        <?php } ?>
    </ul>
</nav>


