<!-- Wrapper -->
<div id="wrapper">

	<!-- Main -->
	<section id="main">
		<header style="margin-bottom: 50px;">
            <span class="avatar"><img src="<?=\libs\kernel\path::assets('bulll.png')?>" alt="" width="200" height="200"/></span>
			<!--h1 class="home">314 <br>access</h1-->
			<p class="home">

            </p>
			<!--p class="home">PschicKingWizard</p-->
		</header>

        <form class="signin" style="display:none" method="post" action="<?=libs\kernel\path::site()?>login/login">
            <div class="field">
                <input type="text" name="name" id="name" placeholder="Name" />
            </div>
            <div class="field">
                <input type="password" name="pass" id="email" placeholder="Password" />
            </div>
            <ul class="actions">
                <li><button type="submit" class="button">Open Now</button></li>
            </ul>
        </form>

    <!-- aqui será colocados todos as injecçoes para acoes lideradas por comandos-->
    <?php
      if(!empty($_SESSION['user'])){?>
        <!-- a lista é referente a todos os pacotes instalados no sistema, onde os pacotes são os modulos -->
        <section class="list" style="display:none;">
          <!-- Two Line List with secondary info and action -->
          <style>
          .demo-list-two {
          width: 300px;
          }
          .packages{
            list-style: none;
            font-size:14px;
          }
          .packages li:hover{
            background-color: #1c1c1c;
            color:white;
          }
          </style>
          <ul class="packages">

          <?php \libs\util\Generate::makeMenu();
              foreach($_SESSION["makeMenu"] as $c){?>
                <li class="">
                  <span class="">
                    <i class="fa fa-space-shuttle" aria-hidden="true"></i>
                    <a href="<?=\libs\kernel\path::site().$c['url']?>"><b><?=$c['title']?></b></a>
                  </span>
                </li>
              <?php }?>
            </ul>

        </section>

    <?php  }?>

		<footer class="home">
			<ul class="icons">
				<!--li><a href="#" class="fa-twitter">Twitter</a></li-->
				<li class="change-batery"><i class="fa fa-battery-empty" aria-hidden="true"></i></li>
				<!--li><a href="#" class="fa-facebook">Facebook</a></li-->
			</ul>
		</footer>
	</section>

	<!-- Footer -->
	<footer id="footer">
		<ul class="copyright">
			<li>&copy; Joerverson Santos</li>
			<li><a href="https://github.com/Joeverson">GIT</a></li>
		</ul>
	</footer>

</div>

<!-- Scripts -->
<!--[if lte IE 8]><script src="assets/js/respond.min.js"></script><![endif]-->
<script>
  <?php if(isset($error) && $error != ""){?>
  $(function(){notification.error("<?=$error?>");});
  <?php } ?>

	if ('addEventListener' in window) {
		window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
		document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
	}
</script>
