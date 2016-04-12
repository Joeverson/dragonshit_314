<?php
include"modules/admin/widgets/header.php";
include"modules/admin/widgets/sidebar.php";

$user = new modules\admin\user\models\DBUser();
?>
<style>
    .col-md-6{
        font-family: "Roboto", "Helvetica", "Arial", sans-serif;
    }
    .demo-card-image.mdl-card {
        width: 256px;
        height: 256px;
        background: url('<?=$endereco?>includes/img/tumblr_nugarh0Kql1ti4wako1_540.gif') center / cover;
    }
    .demo-card-image > .mdl-card__actions {
        height: 52px;
        padding: 16px;
        background: rgba(0, 0, 0, 0.2);
    }
    .demo-card-image__filename {
        color: #fff;
        font-size: 14px;
        font-weight: 500;
    }

    .card-create-user.mdl-card {
        width: 512px;
    }
    .card-create-user > .mdl-card__title {
        color: #000;
        height: 176px;
        background: url('<?=$endereco?>includes/img/LOGO.png') no-repeat center;
        background-size: 60%;
    }
    .card-create-user > .mdl-card__menu {
        color: #fff;
    }

    .card-create-user .mdl-card__supporting-text input, .card-create-user .mdl-card__supporting-text select {
        padding: 10px;
        margin: 5px 0;
        
        font-size: 16px;
        font-family: "Roboto", "Helvetica", "Arial", sans-serif;
    }

</style>


    <div class="row" style="margin-top: 40px;">
        <div class="col-md-10 col-md-offset-2">
            <div class="col-md-6">
                <form id="send-user" class="col-md-12">
                    <!-- Wide card with share menu button -->
                    <div class="card-create-user mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title"></div>
                        <div class="mdl-card__supporting-text">
                            <input class='col-md-12' type="text" id="name" name="name" placeholder="Usuário" required="">
                            <input class='col-md-12' type="email" id="email" name="email" placeholder="E-mail" required="">
                            <input class='col-md-12' type="text" id="" name="login" placeholder="Login de acesso" required="">
                            <input class='col-md-12' type="password" id='pass' name="pass" placeholder="Senha" required="">
                            <input class='col-md-12' type="password" id='pass2' placeholder="re-Senha" required="">
                            <select name="id_tipo" class="col-md-12" style="background-color: transparent;">
                                <option value="-1">Defina os privilegios do usuário</option>
                                <?php foreach($user->selectCat() as $c){
                                    if($c['visible'] == 0){?>
                                    <option value="<?=$c["id_tipo"]?>"><?=$c["name_cat"]?></option>
                                <?php } } ?>
                            </select>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <button type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                Adicionar
                            </button>
                        </div>
                        <div class="mdl-card__menu">
                            <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                                <i class="material-icons">share</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!--lista de ativos-->
            <div class="col-md-6">
                <div class="list-group">
                    <a href="#" class="list-group-item active" style="border-radius: 0;">
                        <h4 class="list-group-item-heading">Pessoas Cadastradas</h4>
                    </a>

                    <ul class="list-group" style="color: white;">
                        <?php foreach($user->selectAllUserOfType($_SESSION['user']['id_user']) as $u){ ?>
                            <li class="list-group-item" style="background-color: transparent; border:none; color:black">
                                <div class="col-md-10">
                                    <span class="badge"><?=$u['name_cat']?></span>
                                    <h4><b><?=$u['name']?></b></h4>
                                    <small><?=$u['email']?></small>
                                </div>
                                <!-- todo fazer uma trigger para deletar em cascata quando apagar o usuario ele deletar tbm a validação associada a ele-->
                                <!-- todo Não irei deletar usuario só seta-lo como inativo, pois no futuro podemos usar as informações do usuario para historico.-->
                                <div class="col-md-2" style="color:black">
                                    <i class="material-icons btn-custom" data-url="<?=$endereco?>admin/user/controller/delete.php" data-msg="Usuário deletado com sucesso!!" data-id="<?=$u['id_user']?>" style="cursor:pointer; color:#808080;">delete</i>
                                    <a href="<?= $site ?>admin/user/editar/<?= $u['id_user'] ?>"><i class="material-icons" style="cursor:pointer; color:#808080;">mode_edit</i></a>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<script>
    $(function(){
        $("#send-user").on("submit",function(){
            event.preventDefault();
            var data = $( this ).serialize();

            var pass = $("#pass");
            var pass2 = $("#pass2");


            if((pass.val() != pass2.val())){
                notification.error('Senhas incorretas.');
                console.log('oxe cadê?');
            }else{
                $.ajax({
                    type: 'post',
                    url: '<?=$endereco?>admin/user/controller/create.user.php',
                    data: data,
                    datatype: 'html',
                    success: function(t){
                        console.log(t);
                        notification.ok('Enviado com Sucesso!!');
                        window.location.reload();
                    },
                    error: function(){
                        notification.ok('Error ao salvar o usuário!!');
                    }
                });
            }
        });


        $(".btn-custom").on("click",function(){
            event.preventDefault();
            var url = $( this ).data("url");
            var id = $( this ).data("id");
            var msg = $( this ).data("msg");

            $.ajax({
                type: 'post',
                url: url,
                data: 'id='+id,
                datatype: 'html',
                success: function(t){
                    console.log(t);
                    notification.ok(msg);
                    window.location.reload();
                },
                error: function(){
                    notification.ok('Houve algum erro no sistema, talvés seja a internet...');
                }
            });

        });


    });


</script>

<?php
include"modules/admin/widgets/rodape.php";
?>
