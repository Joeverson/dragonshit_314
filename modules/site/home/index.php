<?php
    \libs\kernel\File::inject("site/widgets/header.php");
?>
<!-- Wrapper -->
<div id="wrapper">

	<!-- Main -->
	<section id="main">
		<header>
            <span class="avatar"><img src="<?=\libs\kernel\path::path()?>includes/img/avatar-4.png" alt="" width="200" height="200"/></span>
			<h1 class="home">Joerverson <br>Santos</h1>
			<p class="home">PschicKingWizard</p>
		</header>

        <h2 class="signin" style="display:none">Go enter</h2>
        <form class="signin" style="display:none" method="post" action="<?=\libs\kernel\path::site()?>login">
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
	if ('addEventListener' in window) {
		window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
		document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
	}
</script>
