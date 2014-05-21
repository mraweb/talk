<?php 
include_once("classe/Servico.php");
$servico = new Servico();
$servico->setId($idServico);
$servico->geraDadosIdServico();
$logo = URL.'img/'.$servico->getLogo();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<title>Serviço Sem Aúdio | Talk Radio - Soluções em Radiofusão</title>
<link rel="stylesheet" type="text/css" href="<?php echo URL;?>css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo URL;?>css/colorbox.css">
<!--[if ie]>
	<script type="text/javascript" src="<?php echo URL;?>js/html5-ie.js"></script>
<![endif]-->
<?php include "analytics.php"; ?>
</head>
<body itemscope itemtype="http://schema.org/WebPage">

<div class="bg-int">
    <?php include "inc/header.php"; ?>
    
    <div role="main">
        <section id="content">
        	<div itemprop="breadcrumb" id="bread">
                <a href="<?php echo URL;?>" class="link">Home</a> &raquo;
                <a href="<?php echo URL;?>servicos" class="link">Serviços</a> &raquo;
                <strong><?php echo $servico->getNome();?></strong>
            </div>

            <p class="bt-voltar"><a href="javascript:history.back(-1);" title="Voltar" class="hidetxt">Voltar</a></p>
            
            <img src="<?php echo $logo;?>" alt="Logo" class="img-left" />

            <h1 class="titulo pdg-serv"><span><?php echo $servico->getNome();?></span></h1>

            <section class="midias">
                <div class="fb-like" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false"></div>
                <!--<div>
                	<script type="text/javascript">
						!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
					</script>
                    <a href="https://twitter.com/share" class="twitter-share-button" data-lang="pt" data-via="">Tweetar</a>
               	</div>-->
            </section>
            
            <p><?php //echo nl2br($servico->getDescricao());?></p>
            
            <div class="formata">
            <?php 
            	//descricao do produto
            	echo $servico->getDescricaoInterna();
            ?>
            </div>

            <!--<h2 class="h2-impr">Galeria de Fotos</h2>

            <ul class="galeria">
                <li><a href="img/fotogd.jpg" title="<?php // echo $servico->getNome();?>"><img src="img/foto.jpg" alt="<?php // echo $servico->getNome();?>" width="116" height="85" /></a></li>

                <li><a href="img/fotogd.jpg" title="<?php // echo $servico->getNome();?>"><img src="img/foto.jpg" alt="<?php // echo $servico->getNome();?>" width="116" height="85" /></a></li>

                <li><a href="img/fotogd.jpg" title="<?php // echo $servico->getNome();?>"><img src="img/foto.jpg" alt="<?php // echo $servico->getNome();?>" width="116" height="85" /></a></li>
            </ul>-->

            <nav role="navigation">
                <ul id="menu-sem-audio">
                	<?php 
                		$servico->setType('interna');
						$servico->getListServicosSemAudio();
					?>
                </ul>
            </nav>
        </section><!-- FINAL CONTENT --> 
    </div> 
</div>

<?php include "inc/footer.php"; ?>
<script type="text/javascript" src="<?php echo URL;?>js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>js/jquery.colorbox.js"></script>
<script type="text/javascript">
// lightbox
$(document).ready(function(){
    $(".galeria a").colorbox({rel:'galeria a'});
});

$(".formata img").css("margin-right","20px");
</script>
<script type="text/javascript" src="<?php echo URL;?>js/scripts.js"></script>
<script type="text/javascript" charset="UTF-8" src="https://server.iad.liveperson.net/hc/10162590/?cmd=mTagRepstate&amp;site=10162590&amp;buttonID=12&amp;divID=lpButDivID-1372986881120&amp;bt=1&amp;c=1"></script>
</body>
</html>
