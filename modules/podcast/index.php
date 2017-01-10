    <!-- Wide card with share menu button -->


    <div class="container">
        <div class="row">
            <?php foreach($data['channel']['item'] as $d){?>
                <div class="col-md-3" style="margin:20px 0px;">
                    <div class="demo-card-event mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title mdl-card--expand">
                            <div class="container">
                                <div class="row">
                                    <h3 class="text-capitalize"><?=$d['title']?>: </h3>
                                </div>
                                <div class="row">
                                    <p class="text-justify"><?=empty($d['description']) ? "" : substr($d['description'], 0, 100)."[...]"?></p>
                                </div>
                            </div>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <a href='<?=$d['enclosure']['@attributes']['url']?>' target='_blank' class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                Ouvir
                            </a>
                            <div class="mdl-layout-spacer"></div>
                            <i class="material-icons">link</i>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
    <script>
        $(function(){

            //click para abrir a imagem
            $('.btn-click-img').on("click", function(){
                $('.input-img').trigger('click').imgBG(".demo-card-wide > .mdl-card__title");
            });
        });
    </script>
<?php include "modules/admin/widgets/rodape.php"; ?>
