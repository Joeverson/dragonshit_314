
<!--top menu-->
<!-- Uses a transparent header that draws on top of the layout's background -->
<style>
    .layout-transparent {
        background-color:#E0E0E0;
    }
    .layout-transparent .mdl-layout__header,
    .layout-transparent .mdl-layout__drawer-button {
        background-color: rgba(22, 86, 159, 0.7);
        /*background-color: #16569f;*/
        color: white;
    }
    .mdl-layout__drawer{
        background-color: #16569f;
        border:none;
    }
    .mdl-navigation ul li a:hover, .mdl-navigation a:hover{
        color:black;
    }
    input, select {
        padding: 10px;
        margin: 5px 0;
        outline: none;
        font-size: 16px;
        font-family: "Roboto", "Helvetica", "Arial", sans-serif;
    }
</style>
<div class="layout-transparent mdl-layout mdl-layout--fixed-drawer mdl-js-layout">
    <header class="mdl-layout__header mdl-layout__header--transparent">
        <div class="mdl-layout__header-row">
            <!-- Title -->
            <span class="mdl-layout-title">
                <a href="<?= $site ?>admin/dashboard">
                    <img src="<?= $endereco ?>includes/img/LOGO.png" width="120" alt=""/>
                </a>
            </span>
            <!-- Add spacer, to align navigation to the right -->
            <div class="mdl-layout-spacer"></div>

            <!-- Navigation  barra de cima -->
            <nav class="mdl-navigation">
                Olá <?=explode(" ", $_SESSION["user"]["name"])[0]?>
                <a class="mdl-navigation__link" data-toggle="modal" data-target="#myModal" href="#">Fale Conosco</a>
                <a class="mdl-navigation__link" href="<?=$site?>admin/help">Ajuda</a>
                <a class="mdl-navigation__link logout" href="<?=$endereco?>../logout">SAIR</a>
                <!--a href="#"><i class="material-icons">perm_identity</i></a-->
            </nav>
        </div>
    </header>
    <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">
            <a href="<?= $site ?>admin/dashboard">
                <img src="<?= $endereco ?>includes/img/LOGO.png" width="170" alt=""/>
            </a>
        </span>
        <small class="text-center" style="color:white">Avaliação de <?=$action->countDays($action->dateTimeStampConsertAndOrganize($_SESSION['user']['date_fin']))?> dias</small>
        <nav class="mdl-navigation toogle-action-sub">
            <?php foreach($action->makeMenu() as $k){?>
                <?php if(!empty($k['submenu'])){?>
                    <ul class="list-group">
                        <li class="toogle-action">
                            <!-- Left aligned menu below button -->
                            <a style="color:white;" href="<?=$endereco.'../'.$k['url'] ?>" class="mdl-navigation__link link-pretty"><?=$k['title']?></a>
                        </li>
                        <!-- aqui esta os sub menus -->
                        <?php foreach($k['submenu'] as $v){?>

                            <li class="" style="">
                                <a style="color:white;background-color: #1565C0; font-size: 12px" href="<?php if (!empty($v['url'])) echo $endereco.'../'.$v['url'] ?> " class="mdl-navigation__link text-center"><?=$v['title']?></a>
                            </li>

                        <?php } ?>
                    </ul>
                <?php }else{?>
                    <a style="color:white" href="<?=$endereco.'../'.$k['url'] ?>" class="mdl-navigation__link link-pretty"><?=$k['title']?></a>
                <?php }
            }?>

            <nav class="mdl-navigation">
                <h5 class="text-center"><a class="logout" href="<?=$endereco?>../logout">SAIR</a></h5>
            </nav>
        </nav>
    </div>

    <script>
        <? //todo aqui tem um bug no fade in ele vai mostrar todos não o que eu escolhi?>

    </script>


    <!-- Modal -->
    <form id="formEditUser" class="urlForm" data-url="<?=$endereco?>admin/dashboard/controller/faleconosco.php" style="margin-bottom:20px;" data-msg="true">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document" style="z-index: 100000;">
                <div class="modal-content" style="border-radius: 0; box-shadow: 0 0 3px -2px black">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Fale conosco <?=$_SESSION['user']['name']?></h4>
                    </div>
                    <div class="modal-body">
                        <input class='col-md-12' type="text" name="name" placeholder="Usuário" value="<?=$_SESSION['user']['name']?>" required="">
                        <input class='col-md-12' type="email" name="email" placeholder="E-mail" value="<?=$_SESSION['user']['email']?>" required="">
                        <input class='col-md-12' type="text" name="assunto" placeholder="Assunto">
                        <select name="id_tipo" class="col-md-12" style="background:none">
                            <option value="-1">Escolha um topico </option>
                            <option value="sugestao">Sugestão</option>
                            <option value="reclamacao">Reclamação</option>
                            <option value="encontrei-um-erro">Encontrei um erro</option>
                            <option value="outros">Outros</option>
                        </select>
                        <textarea name="observacao" class="col-md-12" rows="10" placeholder="Como poderiamos lhe ajudar?" style="margin-bottom: 30px;" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-success">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>