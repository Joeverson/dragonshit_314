<?php
include "modules/admin/widgets/header.php";
include "modules/admin/widgets/sidebar.php";
//echo file_get_contents(\libs\kernel\path::path()."admin/dashboard/model.php");
//\libs\util\Email::prepare($_SESSION['user']['email'], "Multiplicador Online", file_get_contents(\libs\kernel\path::path()."admin/dashboard/model.php"));
//\libs\util\Email::send();

$fn = new \libs\functions;
$db = new \modules\admin\qualidade\models\DBQualidade;
$fnDate = new \modules\admin\qualidade\controller\fn;
$relatorio = new \modules\admin\pontos\controller\relatorioPontos;

/**
 * Parte resonsavel por manipular informações de qualidade
**/
$dt = $db->getLastDataOfUser(\libs\functions::getIdMultiplicador($_SESSION['user']));
if($dt===false) {$countRegister = 0;}
else $countRegister = $db->getQtAllRegistros($dt['MES_REF'],$dt['ANO_REF'], \libs\functions::getIdMultiplicador($_SESSION['user']));

/**
 * Parte resonsavel por manipular informações de pontos
 **/
$labels = "";
$data = "";
$i=0;
foreach($relatorio->dados() as $k=>$v){
    if($i < 10){
        $labels .= '"'.$k.'",';
        $data .= $v.',';
    }

    $i++;
}

?>
<style>
    .title p{
        font-family: Tahoma, Geneva, sans-serif, "Open Sans";
        color:#1c1c1c;
        line-height: 40px;;
    }
    .title p:nth-child(2){
        font-size: 0.8cm;
    }
    .subtitle-pizza{
        margin-top:20px;
    }
</style>
<div class="container">
    <div class="row text-center" style="">
        <div>
            <?php if($action->countDays($action->dateTimeStampConsertAndOrganize($_SESSION['user']['date_fin'])) < 1){?>
                <div class="col-md-10 col-md-offset-2 title">
                    <p style="font-size: 1.5cm; font-weight: bold;">Olá, <?=$_SESSION['user']["name"]?>!</p>
                    <h3>Seja bem vindo ao Multiplicador Online.</h3> <p style="font-style:italic">A sua ferramenta de gestão para multiplicadores Bradesco Expresso.</p>
                </div>
            <?php }else{?>
                <div class="col-md-10 col-md-offset-2" style="margin-top:40px">
                    <img src="<?= $endereco ?>includes/img/LOGO.png" width="370" alt=""/>
                    <h4 class="text-justify">
                        <br>
                        <h3>Seja bem vindo ao multiplicador online. A sua ferramenta de gestão para multiplicadores Bradesco Expresso.</h3>
                        <br>
                        <p class="text-justify">
                            Aqui é possível gerenciar diversos aspectos da sua atuação como Multiplicador, ajudando na sua
                            tomada de decisão, direcionando melhores práticas e tudo isso, sendo gerenciado apenas por você.
                            Não sendo necessário o envio de nenhum arquivo por email, todos os dados são exclusivamente seus
                            e só quem você definir é que poderá acessá-los.
                            <br>
                            <br/>
                            E este é só o começo! Muito ainda está sendo desenvolvido, pensando na melhoria dos seus resultados. Se tiver alguma sugestão,
                            crítica, dúvida ou elogio, use o menu (<a class="mdl-navigation__link label label-success" data-toggle="modal" data-target="#myModal" href="#">Fale Conosco</a>) a qualquer momento.
                            <br/>
                        </p>
                        <a href="<?=$site?>admin/help" class="btn btn-primary" style="margin:30px 0;">Que tal começar por aqui?</a>
                    </h4>
                </div>
            <?php }?>
        </div>
    </div>

    <?php
	if($countRegister!=0){ 
	?>
    <!-- RELATORIOS BASICOS E GERAIS DE ALGUNS PONTOS ANALIZADOS -->
    <div class="row col-md-10 col-md-offset-2">
        <?php if($dt != null){?>
            <div class="col-md-6 ">
                <div class="well">
                    <div class="row">
                        <h3 class="text-center" style="margin:30px 0;">ERROS MAIS ENCONTRADOS - <?=\libs\util\Date::$MOUNTH[$dt['MES_REF']]."/20".$dt['ANO_REF']?> </h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-md-offset-1 pie-charts">
                            <?php
                            $i=0;
                            foreach($fnDate->tallProblem($dt['MES_REF'], $dt['ANO_REF'], \libs\functions::getIdMultiplicador($_SESSION['user'])) as $f){
                                $info[$i]['porcent'] = ($f['count'] / $countRegister)*360;//porcentagem com base no grafico de pizza de 360 o total
                                $info[$i]['porcentIn100'] = ($f['count'] / $countRegister)*100;//porcentagem com base em 100%
                                $info[$i]['title'] = str_replace('_', ' ', $f['title']);
                                $i++;
                            }
                            ?>
                            <div class="pie-chrt">
                                <canvas id="doughnut" height="300" width="300"></canvas>
                                <script>
                                    var doughnutData = [
                                        {
                                            value: <?=$info[0]['porcent']?>,
                                            color:"#F7464A"
                                        },
                                        {
                                            value : <?=$info[3]['porcent']?>,
                                            color : "#46BFBD"
                                        },
                                        {
                                            value : <?=$info[1]['porcent']?>,
                                            color : "#FDB45C"
                                        },
                                        {
                                            value : <?=$info[4]['porcent']?>,
                                            color : "#949FB1"
                                        },
                                        {
                                            value : <?=$info[2]['porcent']?>,
                                            color : "#4D5360"
                                        }

                                    ];

                                    new Chart(document.getElementById("doughnut").getContext("2d")).Doughnut(doughnutData);
                                </script>
                            </div>
                        </div>
                    </div>

                    <!-- legendas do grafico de pizza -->

                    <div class="row" style='margin-top:30px;'>
                        <div class="col-md-12 subtitle-pizza">
                            <div class="block-color" style="background-color: #F7464A"><b style="color:white; margin-left:10px"><?=number_format($info[0]['porcentIn100'], 2).'%'?>></b></div>
                            <b><?=$info[0]['title']?></b>
                        </div>
                        <div class="col-md-6 subtitle-pizza">
                            <div class="block-color" style="background-color: #FDB45C"><b style="color:white; margin-left:10px;"><?=number_format($info[1]['porcentIn100'], 2).'%'?></b></div>
                            <b><?=$info[1]['title']?></b>
                        </div>
                        <div class="col-md-6 subtitle-pizza">
                            <div class="block-color" style="background-color: #4D5360"><b style="color:white; margin-left:10px;"><?=number_format($info[2]['porcentIn100'], 2).'%'?></b></div>
                            <b><?=$info[2]['title']?></b>
                        </div>
                        <div class="col-md-6 subtitle-pizza">
                            <div class="block-color" style="background-color: #46BFBD"><b style="color:white; margin-left:10px;"><?=number_format($info[3]['porcentIn100'], 2).'%'?></b></div>
                            <b><?=$info[3]['title']?></b>
                        </div>
                        <div class="col-md-6 subtitle-pizza">
                            <div class="block-color" style="background-color: #949FB1"><b style="color:white; margin-left:10px;"><?=number_format($info[4]['porcentIn100'], 2).'%'?></b></div>
                            <b><?=$info[4]['title']?></b>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <a href="<?= \libs\kernel\path::site() ?>admin/relatorios" class="btn btn-primary">Ver Completo</a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- RELATORIOS DE PONTOS  -->

            <div class="box col-md-6 demo-card-wide mdl-card mdl-shadow--2dp">
                <div class="row col-md-12" align="center">
                    <h2>Total de pontos cadastrados: <? print($relatorio->contaPontos()); ?></h2>
                </div>
                <div class="row col-md-12">
                    <h4>Top 10 - Agências com mais correspondentes</h4>
                    <canvas id="myBarChart" width="430" height="400"></canvas>
                </div>
                <div class="row" style="margin:30px 0;">
                    <div class="col-md-4 col-md-offset-4">
                        <a href="<?= \libs\kernel\path::site() ?>admin/relatorios" class="btn btn-primary">Ver Completo</a>
                    </div>
                </div>
            </div>


            <script>
                var data = {
                    labels: [<?=$labels?>],
                    datasets: [
                        {
                            label: "Agencias",
                            fillColor: " rgba(22, 86, 159, 0.7)",
                            strokeColor: "rgba(151,187,205,1)",
                            pointColor: "rgba(151,187,205,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(151,187,205,1)",
                            data: [<?=$data?>]
                        }
                    ]
                };
                window.onload = function(){
                    var ctx = document.getElementById("myBarChart").getContext("2d");
                    var myBarChart = new Chart(ctx).HorizontalBar(data, {
                        responsive: false,
                        barShowStroke: false,
                        scaleShowGridLines : false
                    });
                };
            </script>

        <?php } }?>
    </div>


</div>

<script>
    $(function(){
        notification.fixed("O sistema será atualizado neste sábado dia 09/04/2016 às 23:00hs. ");
    });
</script>

<?php

include "modules/admin/widgets/rodape.php";
?>
