<?php
include "modules/admin/widgets/header.php";

?>

	<!-- Wide card with share menu button -->
	<style>
		.login{
			padding:0;
		}

		.login > .mdl-card__title {
			color: #fff;
			height: 176px;
			background: url('<?= $endereco ?>includes/img/LOGO.png') no-repeat;
			background-position: center;
			background-size: 60%;
			background-color:#16569f;

		}
		.demo-card-wide > .mdl-card__menu {
			color: #fff;
		}
		input{
			font-size:16px;
			margin:10px 0;
			outline:none;
		}

        .cadastro input, .login input{
            padding:0;
        }
	</style>
	</head>

	<body>

	<div id="container">
		<div class="row col-md-10 col-md-offset-1" style="margin-top: 30px;">
			<div class="col-md-6">
				<form action="<?=$endereco?>../login" method='post' class="form-login">
					<div class="demo-card-wide mdl-card mdl-shadow--2dp col-md-12 login">
						<div class="mdl-card__title col-md-12">
							<!--h2 class="mdl-card__title-text">Welcome!!</h2-->
						</div>
						<div class="mdl-card__supporting-text">
							<div class="row">
								<div class="col-md-6" style="font-size: 16px">
									Usuário
									<input name="name" class='col-md-12'  type="text" required="" placeholder="">
								</div>
								<div class="col-md-6" style="font-size: 16px">
									Senha
									<input name="pass" type="password" class='col-md-12' required="" placeholder="">
								</div>
							</div>
						</div>
						<div class="mdl-card__actions mdl-card--border">
							<button type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
								ENTRAR
							</button>
						</div>
						<div class="mdl-card__menu"></div>
					</div>
				</form>
			</div>
			<div class="col-md-4 col-md-offset-1">
				<form id="cadastrar" class="form-login urlForm" data-url="<?=$endereco?>admin/login/controller/cadastrar.php">
					<div class="demo-card-wide mdl-card mdl-shadow--2dp col-md-12 cadastro" style="padding:0;">
						<div class="mdl-card__title" style="height: 60px; background-color:#16569f; color:white;">
							<h2 class="mdl-card__title-text">Cadastrar-se</h2>
						</div>
						<div class="mdl-card__supporting-text col-md-12" style="padding: 10px 20px; 0 20px">
							<div class="row">
								<div class="col-md-12">
									Nome Completo
									<input name="name" class='col-md-12' style='' value="" type="text" required="" placeholder="">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									E-mail
									<input name="email" class='col-md-12' type="email" value="" required="" placeholder="">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									Telefone
									<input name="tel" class='col-md-12' style='' type="number" required="" value="" placeholder="">
								</div>
								<div class="col-md-6">
									Telefone 2
									<input name="tel2" class='col-md-12' style='' type="number" placeholder="">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									Código do multipicador
									<input name="cod_multiplicador" class='col-md-12' value="" type="number" required="" placeholder="">
								</div>
								<div class="col-md-4">
									Estado( UF )
									<input name="uf" class='col-md-12'  type="text" required="" value="" placeholder="">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									Nome de Usuário
									<input name="login" class='col-md-12'  value="" type="text" required="" placeholder="">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									Senha
									<input name="pass2" class='col-md-12'  type="password" required="" placeholder="">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									Coloque a senha novamente
									<input name="pass1" class='col-md-12'  type="password" required="" placeholder="">
								</div>
							</div>
						</div>
						<div class="mdl-card__actions mdl-card--border">
							<button type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
								Cadastrar
							</button>
						</div>
						<div class="mdl-card__menu"></div>
					</div>
				</form>
			</div>
			<script>

				<?php if(isset($error) && $error != ""){?>
				$(function(){notification.error("<?=$error?>");});
				<?php } ?>


				//formulario de edição de usuario
				$("#cadastrar").on("submit",function(){
					event.preventDefault();
					var url = $(".urlForm").data('url');

                    console.log("senha 1:"+$("input[name=pass1]").val());
                    console.log("senha 2:"+$("input[name=pass2]").val());


					if($("input[name=pass1]").val() != $("input[name=pass2]").val()){
						/**
						 * todo mudar essa condifional ele ta dando bug (deve ser diferente ele manda a mensagem mas ele
						 * não ta recuperando o valor de um carinha)
						 * */

						notification.error("Senhas não conferem, as senhas precisam ser iguais.");
					}else{

						$.ajax({
							url: url,
							type: 'post',
							data:  new FormData(this),
							datatype: 'html',
							cache: false,
							contentType: false,
							processData: false,
							beforeSend: function(){
								$('.progress-bar').show();
							},
							complete: function() {
								$('.progress-bar').fadeOut();
							},
							success: function(e){
                                console.log(e);
                                //analisa e prepara emite mensagens dependendo do que vem do php ver (\Documentaçao\menssages.txt)
                                anmer.analise(JSON.parse(e), "<?=$site?>admin/dashboard");
							}
						});
					}
				});

			</script>

	</body>
<?php
include "modules/admin/widgets/rodape.php";
?>