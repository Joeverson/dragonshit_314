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
